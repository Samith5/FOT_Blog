<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginIndex()
    {
        return view('dashboard.login');
    }
    public function login(Request $req)
    {
        $email = $req['email'];
        $password = $req['password'];

        $admin = User::where(['email' => $email, 'user_type' => 'ADMIN', 'status' => '0', 'is_verified' => '1'])->first();

        if ($admin) {

            if ($password != $admin->password) {
                Session::flash('status', "The password you entered is incorrect.");
                return redirect()->back();
            } else {
                Auth::login($admin);
                $req->session()->put('admin', [$admin->email, $admin->first_name, $admin->last_name]);
                return redirect()->route('dashboard.home');
            }
        }

        Session::flash('status', "The email you entered is incorrect.");
        return redirect()->back();
    }


    public function logout()
    {
        Auth::logout();
        FacadesAuth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
