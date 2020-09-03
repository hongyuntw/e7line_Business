<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
//    public function redirectTo()
//    {
//        return route('admin_dashboard.index');
//    }

    protected function loggedOut(Request $request) {
        return redirect('/login');
    }

    public function authenticated()
    {
        if(auth()->user()->type == 1)
        {
            return redirect('/admin');
        }

        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1])) {

            $user = Auth::user();
            if($user->company->is_active == 0){
                Session::flash('alert', 'failed');
                Session::flash('msg','貴公司已被停用');
                Auth::logout();
                return view('auth.login');
            }

            return redirect()->intended('/admin');
        }
        else {
            $this->incrementLoginAttempts($request);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
//                帳號密碼沒錯但是業務失效
                Session::flash('alert', 'failed');
                Session::flash('msg','使用者停用');
                Auth::logout();
            }
            else{
                Session::flash('alert', 'failed');
                Session::flash('msg','帳號或密碼錯誤');

            }

            return view('auth.login');

        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }






}
