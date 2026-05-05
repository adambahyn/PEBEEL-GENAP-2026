<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // otomatis ke-hash
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('/customer');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/customer');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/customer');
    }
}