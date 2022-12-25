<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login62Controller extends Controller
{

    public function login62(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $isLogin = Auth::attempt($request->only('email', 'password'));

        if ($isLogin) {
            $user = Auth::user();

            if ($user->role == "user" && $user->is_active == 1) {
                return redirect('/dashboard62');
            }

            if ($user->role == "admin") {
                return redirect('/dashboard62');
            }

            if ($user->role == "user" && $user->is_active == 0) {
                Auth::logout();
                return back()->with('error', 'Your account is not activated by Adminstrator');
            }
        }

        return back()->with('error', 'Username or password not correct!');
    }
}
