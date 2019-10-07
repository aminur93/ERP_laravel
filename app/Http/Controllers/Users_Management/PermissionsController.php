<?php

namespace App\Http\Controllers\Users_Management;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Auth, Validator, ACL;

class PermissionsController extends Controller
{
    // permission, redirect, message
    static protected $acl = array(
        "permission" => "users_management" 
    );

    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        ACL::check(self::$acl); 

        $title  = "Add Permission";
        $button = "Save";
        $permissions = Permission::all(); 

        //get permission by id
        $permission = [];
        if ($request->get('id'))
        { 
            $title  = "Update Permission";
            $button = "Update";
            $permission = Permission::findOrFail($request->get('id'));
        }

        return view('users_management.permissions.index', compact('permissions', 'permission', 'title', 'button'));
    } 

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        ACL::check(self::$acl); 

        $validator = Validator::make($request->all(),[ 
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);  

        if ($validator->fails())
        { 
            return redirect('users_management/permissions')
                ->withErrors($validator)
                ->withInput();
        }
        else
        { 
            if ($request->id)
            { 
                $permission = Permission::findOrFail($request->id);
                if ($permission->update($request->all()))
                {
                    return redirect('users_management/permissions')
                        ->with("success", "Update Successful!");
                }
                else
                {
                    return redirect('users_management/permissions')
                        ->with("error", "Please try again.")
                        ->withInput();
                }

            }
            else
            {
                if (Permission::create($request->all()))
                {
                    return redirect('users_management/permissions')
                        ->with("success", "Save Successful!")
                        ->withInput();
                }
                else
                {
                    return redirect('users_management/permissions')
                        ->with("error", "Please try again.")
                        ->withInput();
                }
            }
        }   
    }

 
    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        ACL::check(self::$acl); 
        
        $permission = Permission::findOrFail($request->id);
        if ($permission->delete())
        {
            return redirect('users_management/permissions')
                ->with("success", "Delete Successful!");
        }
        else
        {
            return redirect('users_management/permissions')
                ->with("error", "Please try again.")
                ->withInput();
        }
    }

}
