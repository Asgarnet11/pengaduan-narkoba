<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::id()) {
            $role = Auth()->user()->role;

            if ($role == 'admin') {
                $users = User::all();
                return view('admin.DaftarAkun.index', compact('users'));
            } else {
                return redirect()->route('admin.dasboard');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nik' => 'required|min:16',
            'password' => 'required|min:8',
            'role' => 'required|string',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);


        return redirect()->route('admin.DaftarAkun.index');
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            // Handle if the user is not found, e.g., redirect or show an error message
            return redirect()->route('home')->with('error', 'User not found.');
        }

        return view('admin.DaftarAkun.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nik' => 'required|string|max:16',
            'password' => 'nullable|min:8',
            'role' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            // Handle if the user is not found, e.g., redirect or show an error message
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // For debugging, print the hashed password
        // dd($user->password);

        // Save the changes
        $user->save();

        // Redirect to a success page or do something else
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
        }

        // Handle if the user is not found
        return redirect()->route('admin.dashboard')->with('error', 'User not found.');
    }
}
