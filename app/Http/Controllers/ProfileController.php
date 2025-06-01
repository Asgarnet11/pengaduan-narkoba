<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');

                // Validasi ukuran dan tipe file
                if ($foto->getSize() > 2 * 1024 * 1024) {
                    return back()->with('error', 'Ukuran file tidak boleh lebih dari 2MB');
                }

                if (!in_array($foto->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                    return back()->with('error', 'Format file harus JPG, JPEG, atau PNG');
                }

                // Hapus foto lama jika ada
                if ($user->foto) {
                    Storage::disk('public')->delete($user->foto);
                }

                // Upload foto baru dengan nama unik
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('profile', $fileName, 'public');
                $data['foto'] = $path;
            }

            $user->update($data);

            // Force refresh the model to get the latest data
            $user = $user->fresh();

            return back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
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
