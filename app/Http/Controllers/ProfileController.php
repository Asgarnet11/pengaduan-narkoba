<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik,' . $user->id, 'regex:/^[0-9]{16}$/'],
            'telp' => ['required', 'string', 'max:15', 'regex:/^[0-9]{10,15}$/'],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nik.regex' => 'NIK harus terdiri dari 16 digit angka',
            'telp.regex' => 'Nomor telepon harus terdiri dari 10-15 digit angka'
        ]);

        $data = $request->only(['name', 'email', 'nik', 'telp']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }

            // Upload foto baru
            $foto = $request->file('foto');
            $path = $foto->store('profile', 'public');
            $data['foto'] = $path;
        }

        try {
        $user->update($data);
        return back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/']
        ], [
            'password.regex' => 'Password harus mengandung minimal 1 huruf besar, 1 huruf kecil, dan 1 angka'
        ]);

        try {
        Auth::user()->update([
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', 'Password berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui password');
        }
    }
}
