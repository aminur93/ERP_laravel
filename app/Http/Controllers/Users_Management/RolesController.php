<?php
namespace App\Http\Controllers\Users_Management;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller; 
use Auth, Validator, ACL; 

class RolesController extends Controller
{
    // permission, redirect, message
    static protected $acl = array(
        "permission" => "users_management" 
    );

    /**
    * Display a listing of Role.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {  
        ACL::check(self::$acl); 
        
        $title = "Add Role";
        $button= "Save";
        $roles = Role::all();
        $permissions = Permission::get()->pluck('name', 'name');

        // role by id
        $role = [];
        if (!empty($request->id))
        { 
            $title  = "Update Role";
            $button = "Update";
            $role = Role::findOrFail($request->id); 
        }

        return view('users_management.roles.index', compact(
            'role', 
            'roles', 
            'permissions', 
            'title', 
            'button'
        ));
    }
 

    /**
    * Store a newly created Role in storage.
    *
    * @param  \App\Http\Requests\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {     
        ACL::check(self::$acl);     

        $validator = Validator::make($request->all(),[ 
            'name' => 'required|string|max:255|unique:roles,name,'. $request->id,
        ]);  

        if ($validator->fails())
        { 
            return redirect('users_management/roles')
                ->withErrors($validator)
                ->withInput();
        }
        else
        { 
            if ($request->id)
            { 
                //update
                $role = Role::findOrFail($request->id);
                $role->update($request->except('permission'));
                $permissions = $request->input('permission') ? $request->input('permission') : [];

                if ($role->syncPermissions($permissions))
                {
                    return redirect('users_management/roles')
                        ->with("success", "Update Successful!");
                }
                else
                {
                    return redirect('users_management/roles')
                        ->with("error", "Please try again.")
                        ->withInput();
                }

            }
            else
            {
                //insert
                $role = Role::create($request->except('permission'));
                $permissions = $request->input('permission') ? $request->input('permission') : []; 

                if ($role->givePermissionTo($permissions))
                {
                    return redirect('users_management/roles')
                        ->with("success", "Save Successful!");
                }
                else
                {
                    return redirect('users_management/roles')
                        ->with("error", "Please try again.")
                        ->withInput();
                }
            }
        }    
    }
  


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {     
        ACL::check(self::$acl); 

        $role = Role::findOrFail($request->id);
        if ($role->delete())
        {
            return back()
                ->with("success", "Delete Successful!");
        }
        else
        {
            return back()
                    ->with("error", "Please try again.");

        }
    }
  
}
