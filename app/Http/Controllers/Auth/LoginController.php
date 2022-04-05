<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login', ['url' => 'user']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login/user');
    }


    public function userLogin(Request $request)
    {
        //Error messages
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 8 characters",
            "password" => "Wrong password"
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ], $messages);

        if ($validator->fails()) {
            return back()->withInput($request->only('email', 'remember'))->withErrors($validator);
        } else {
            if (Auth::guard('user')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->get('remember'))) {
                if (Auth::guard('user')->user()->is_admin == 0) {
                    return redirect()->intended('/home');
                } else {
                    return redirect()->intended('/admin');
                }
            } else {
                $validator->getMessageBag()->add('password', 'Wrong password');
                return back()->withInput($request->only('email', 'remember'))->withErrors($validator);
            }
        }
    }
}
