<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }    

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    public function showLoginForm()
    {
        return redirect()->route('events.index');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('index');
    } 

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }
    
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended(route('index'));
    }  

    protected function guard()
    {
        return Auth::guard();
    }

    protected function attemptLogin(Request $request)
    {
        $confirm = Auth::guard('admin-web')->attempt($this->credentials($request), $request->filled('remember'));

        if(!$confirm){
            $confirm = Auth::guard('creditor-web')->attempt($this->credentials($request), $request->filled('remember'));

            if(!$confirm){
                $confirm = Auth::guard('user-web')->attempt($this->credentials($request), $request->filled('remember'));
            }
        }

        return $confirm;
    }   
}
