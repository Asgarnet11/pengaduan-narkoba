<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); // Memvalidasi inputan email dan password

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Mengatur ulang session untuk mencegah session fixation attack

            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin/dashboard')->with('Berhasil', 'Anda berhasil login.');
            } else {
                return redirect()->intended('/dashboard')->with('Berhasil', 'Anda berhasil login.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|size:16|unique:users',
            'telp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'telp' => $request->telp,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat'
        ]);

        return redirect('/login')->with('Berhasil', 'Akun Anda berhasil dibuat. Silakan login.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate(); // Menghapus session yang ada
        $request->session()->regenerateToken(); // Mengatur ulang token CSRF

        return redirect('/')->with('Berhasil', 'Anda berhasil logout.');
    }
}
