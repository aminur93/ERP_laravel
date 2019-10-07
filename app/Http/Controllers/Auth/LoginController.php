<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator, DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        $identity  = request()->get('identity');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'associate_id';
        request()->merge([$fieldName => $identity]);
        return $fieldName;
    }


    /**
     * Validate the user login.
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'identity' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'identity.required' => 'Associate ID or email is required',
                'password.required' => 'Password is required',
            ]
        );
    }

    
    public function forgotPassword(){
        return view('auth/password_request');
    }


    public function passwordRequest(Request $request){
        $validator= Validator::make($request->all(),[
            'associate_id' => 'max:10| min:10'
        ]);

        if($validator->fails())
        {
            return redirect('password_request')->with('error',"Incorrect Associate ID");
        }
        else
        {
            $user = DB::table('users')->where('users.associate_id', '=', $request->associate_id)->first();


            if ($user)
            {
                DB::table('users')->where('users.associate_id','=', $request->associate_id)->update(['password_request' => 1]);
            }
            else
            {
                return redirect('password_request')->with('error',"Incorrect Associate ID");
            }

                return redirect('password_request')->with('success',"Password reset requested successfully!");
        }
        // return redirect('login');
    }
  
    public function logout()
    {
        if (isset(auth()->user()->associate_id))
        DB::table("users_login_activities")
            ->where("associate_id", auth()->user()->associate_id)
            ->whereNull("logout_at")
            ->orderBy("id", "DESC")
            ->limit(1)
            ->update([
                'logout_at' => date("Y-m-d H:i:s")
            ]);

        auth()->logout();
        session()->flash('message', 'Some goodbye message');
        return redirect('/login');
      }
}
