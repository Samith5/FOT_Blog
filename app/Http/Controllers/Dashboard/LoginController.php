<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function adminLogin(Request $req)
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


    public function adminLogout()
    {
        Auth::logout();
        FacadesAuth::logout();
        Session::flush();
        return redirect()->route('adminLogin');
    }
}
//!Hash::check($password, $admin->password
