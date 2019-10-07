<?php

namespace App\Http\Controllers\Users_Management;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller; 
use App\Models\Hr\Employee;
use App\Models\Hr\Unit;
use App\Models\Merch\Buyer;
use Validator, DB, Auth, DataTables;
use ACL;

class UsersController extends Controller
{  
    // permission, redirect, message
    static protected $acl = array(
        "permission" => "users_management" 
    );

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {    
        ACL::check(self::$acl);   
        return view('users_management.user.index');
    }

    public function getUserData()
    { 
        ACL::check(self::$acl); 

        DB::statement(DB::raw('set @serial_no=0'));
        $data = User::select(
                DB::raw('@serial_no := @serial_no + 1 AS serial_no'), 
                'users.*'  
            ) 
            ->where(function($q) {
                $uids = auth()->user()->unit_permissions();
                $first = (isset($uids[0])?$uids[0]:null);
                $q->whereRaw("FIND_IN_SET($first, users.unit_permissions)");
                for ($i=1; $i<count($uids); $i++) 
                {
                    $q->orWhereRaw("FIND_IN_SET($uids[$i], users.unit_permissions)");
                }
            }) 
            ->where(function($q) {
                if (Auth::user()->associate_id != 9999999999)
                {
                    $q->whereNotIn("users.associate_id", [9999999999]);
                }
            })
            ->get(); 
 
        return DataTables::of($data) 
            ->addColumn('units', function ($data) { 
                $result = "";
                $units = explode(",", $data->unit_permissions);
                foreach ($units as $unit):
                    $name = DB::table("hr_unit")->where("hr_unit_id", $unit)->value("hr_unit_name");
                    if (!empty($name))
                    $result .= "<span class=\"label label-primary\">$name</span> ";
                endforeach;
                return $result;  
            })  
            ->addColumn('roles', function ($data) {  
                $roles = "";
                foreach ($data->roles()->pluck('name') as $role):
                    $roles .= "<span class=\"label label-info\">$role</span> ";
                endforeach;
                return $roles;  
            })
        

            ->addColumn('buyer', function ($data) { 
                $i=1;
                $result = "";
                
                $buyerList = explode(",", $data->buyer_permissions);
                foreach ($buyerList as $buyer):
                    $name = DB::table("mr_buyer")->where("b_id", $buyer)->value("b_name");
                    if (!empty($name)){
                    $result .=$i.".".$name."<br/>";
                    $i++;
                    }
                endforeach;
                return $result;  
            })   
            ->addColumn('action', function ($data) { 
                if ($data->associate_id == 9999999999)
                {
                    return "<a href=".url('users_management/user/edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>";
                }
                else
                {
                    return "<a href=".url('users_management/user/edit/'.$data->id)." class=\"btn btn-xs btn-primary\" data-toggle=\"tooltip\" title=\"Edit\">
                        <i class=\"ace-icon fa fa-pencil bigger-120\"></i>
                    </a>
                    <a href=".url('users_management/user/delete/'.$data->id)." onclick=\"return confirm('Are you sure?');\" class=\"btn btn-xs btn-danger\" data-toggle=\"tooltip\" title=\"Delete\">
                        <i class=\"ace-icon fa fa-trash bigger-120\"></i>
                    </a>"; 
                }

            })   
            ->rawColumns(['serial_no', 'units', 'buyer', 'roles', 'action'])
            ->make(true);
    }


    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ACL::check(self::$acl); 

        $roles = Role::get()->pluck('name', 'name');
        $units = Unit::get();
        $buyerList= Buyer::get();
        return view('users_management.user.create', compact('roles', 'units','buyerList'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        ACL::check(self::$acl); 
        $validator = Validator::make($request->all(),[ 
            'name'     => 'required|string|max:255',
            'associate_id' => 'required|string|max:10|unique:users,associate_id',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles'    => 'required',
            'unit_permissions.*' => 'required|max:11|min:1',
            'buyer_permissions.*' => 'max:11'  
        ]);   

        if ($validator->fails())
        {  
            return redirect('users_management/user/create')
                ->withErrors($validator)
                ->withInput();
        }
        else
        { 
            $unit_permissions = implode(",", $request->input("unit_permissions"));
            $request->request->add(['unit_permissions' => $unit_permissions]);

            $buyer_permissions = implode(",", $request->input("buyer_permissions"));
            $request->request->add(['buyer_permissions' => $buyer_permissions]);

            $user = User::create($request->all());
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);
 
            return redirect('users_management/user/create')
                ->withInput()
                ->with('success', 'Save Successful.');
        } 
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    { 
        ACL::check(self::$acl); 

        $roles = Role::get()->pluck('name', 'name');

        $user = User::findOrFail($request->id);
        $units = Unit::get();
        $buyerList= Buyer::get();

        return view('users_management.user.edit', compact('user', 'units', 'buyerList', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        ACL::check(self::$acl); 

        $validator = Validator::make($request->all(),[ 
            'name'     => 'required|string|max:255',
            'associate_id' => 'required|string|max:10|unique:users,associate_id,'.$request->id,
            'email'    => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6|confirmed',
            'roles'    => 'required', 
            'unit_permissions.*' => 'required|max:11|min:1' 
        ]);  


        if ($validator->fails())
        { 
            return redirect('users_management/user/edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }
        else
        { 
            $user = User::findOrFail($request->id);

            $unit_permissions = implode(",", $request->input("unit_permissions"));
            $request->request->add(['unit_permissions' => $unit_permissions]);

            $buyer_permissions = implode(",", $request->input("buyer_permissions"));
            $request->request->add(['buyer_permissions' => $buyer_permissions]);

            $user->update($request->all());
           

            $roles = $request->input('roles') ? $request->input('roles') : [];

            $user->syncRoles($roles);

            return redirect('users_management/user/edit/'.$request->id)
                ->with('success', 'Update Successful.');
        }
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ACL::check(self::$acl); 

        $user = User::whereNotIn('associate_id', ['9999999999'])
            ->findOrFail($request->id);

        if ($user->delete())
        {
            return redirect('users_management/users')
                ->with("success", "Delete Successful!");
        }
        else
        {
            return redirect('users_management/users')
                    ->with("error", "Please try again.");

        }
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        ACL::check(self::$acl); 

        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    # Search Associate ID returns NAME & ID
    public function userDropdown(Request $request)
    { 
        $data = [];

        if($request->has('keyword'))
        {
            $search = $request->keyword;
            $data = DB::table("hr_as_basic_info")
                ->select("associate_id", DB::raw('CONCAT_WS(" - ", associate_id, as_name) AS associate_name'))
                ->where("associate_id", "LIKE" , "%{$request->keyword}%" )
                ->orWhere('as_name', "LIKE" , "%{$request->keyword}%" )
                ->get();
        }

        return response()->json($data);
    } 

}
