<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Events\Registered;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // otomatis ke-hash (karena casts di model User)
            'role' => 'user'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/email/verify')->with('success', 'Registrasi sukses! Silakan verifikasi email Anda.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}