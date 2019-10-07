<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Gate;

/*
* @helper      - ACL
* @description - Check access control 
* @author      - Md. Shohrab Hossain <sourav.diubd@gmail.com>
* @created at  - 27 May, 2018
*/

class ACL
{ 
    static protected $permission = "users_management";
    static protected $redirect   = "login"; 
    static protected $message    = "Unauthorized permission"; 

    static public function check($acl = [])
    { 
        self::$permission = (!empty($acl["permission"])?($acl["permission"]):(self::$permission));
        self::$redirect   = (!empty($acl["redirect"])?($acl["redirect"]):(self::$redirect));
        self::$message    = (!empty($acl["message"])?($acl["message"]):(self::$message));

        if (Gate::allows(self::$permission) == false) 
        {  
            return redirect(self::$redirect)
                ->send()
                ->with("error", self::$message); 
        }    
    }
}

