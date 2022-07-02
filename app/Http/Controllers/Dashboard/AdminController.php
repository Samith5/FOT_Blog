<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function changePassword(Request $request)
    {
        $oldP = $request->oldP;
        $newP = $request->newP;

        $email = Session::get('admin')[0];

        $admin = User::where(['email' => $email, 'user_type' => 'ADMIN', 'status' => '0', 'is_verified' => '1'])->get();

        $newPass = Hash::make($newP);

        if (Hash::check($oldP, $admin[0]->password)) {
            $affected = DB::table('users')->where('email', $email)
                ->update(['password' => $newPass]);

            if ($affected) {
                return 1;
            }
        }
        return 0;
    }
}
