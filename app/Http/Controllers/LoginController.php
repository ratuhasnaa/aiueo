<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('admin.login'); // arahkan ke Blade view yang udah kamu buat
    }

    // Proses login user
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');        }

        // Kalau gagal
        return back()->withErrors([
            'email' => 'Email or password is incorrect',
        ]);
    }

    // Opsional: logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
