<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];

        return view('auth.login', $data);
    }

    public function actionLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $login = [
            'username' => $username,
            'password' => $password
        ];
        // dd($login);

        if (Auth::attempt($login)) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
