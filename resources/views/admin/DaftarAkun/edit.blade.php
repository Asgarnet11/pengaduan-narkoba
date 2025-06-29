@extends('layouts.admin')

@section('title', 'admin.dashboard')

@section('content')
    <div class="min-h-screen bg-gray-900 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white sm:text-3xl">Edit User</h2>
                <p class="mt-2 text-sm text-gray-400">Update user information</p>
            </div>

            <!-- Form Container -->
            <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="post" class="p-6 sm:p-8">
                    @csrf
                    @method('put')

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            Nama
                        </label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Nama petugas" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="nama@gmail.com" required>
                    </div>

                    <!-- NIK Field -->
                    <div class="mb-6">
                        <label for="nik" class="block text-sm font-medium text-gray-300 mb-2">
                            NIK
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ $user->nik }}"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="75050 dst..." required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            Password
                            <span class="text-xs text-gray-500">(kosongkan jika tidak ingin mengubah)</span>
                        </label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Password baru">
                    </div>

                    <!-- Role Field -->
                    <div class="mb-8">
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-2">
                            Role
                        </label>
                        <select id="role" name="role"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="masyarakat" {{ $user->role === 'masyarakat' ? 'selected' : '' }}>
                                Masyarakat
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg text-sm text-center transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none text-white font-medium rounded-lg text-sm transition duration-200">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
