@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-w-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Enhanced Header with Actions -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h1 class="text-3xl font-bold text-blue-500 dark:text-blue-800">Management Pengguna</h1>
                        <p class="font-semibold mt-2 text-gray-600 dark:text-blue-400">
                            Manage Pengguna website, dan Manage Role Pengguna
                        </p>
                    </div>
                    <!-- Stats Cards -->
                    <div class="flex space-x-4">
                        <div
                            class="bg-white dark:bg-blue-800 px-4 py-2 rounded-lg shadow-sm border border-blue-200 dark:border-blue-700">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $users->count() }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Total Pengguna</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Table Container -->
            <div
                class="bg-white dark:bg-blue-600 shadow-xl border border-gray-200 dark:border-blue-600 rounded-xl overflow-hidden">
                <!-- Table Header with Search -->
                <div
                    class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-blue-500 dark:to-blue-700 border-b border-gray-200 dark:border-blue-600">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 sm:mb-0">All Users</h2>
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <input type="text" placeholder="Search users..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-blue-500 rounded-lg bg-white dark:bg-blue-200 text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desktop Table -->
                <div class="hidden lg:block">
                    <table class="min-w-full">
                        <thead class="bg-blue-50 dark:bg-blue-600/50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <span>User</span>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    NIK
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                                    <!-- User Info -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                                <span class="text-lg font-bold text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    Member since
                                                    {{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- NIK -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm font-mono text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                            {{ $user->nik }}
                                        </div>
                                    </td>

                                    <!-- Contact -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-300">{{ $user->email }}</div>
                                    </td>

                                    <!-- Role -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $user->role == 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                            {{ $user->role == 'user' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                            {{ !in_array($user->role, ['admin', 'user']) ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}">
                                            @if ($user->role == 'admin')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 dark:text-blue-400 dark:hover:text-blue-300 text-xs font-medium rounded-lg transition-all duration-200 group-hover:shadow-md">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="{{ route('admin.user.delete', $user->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-400 dark:hover:text-red-300 text-xs font-medium rounded-lg transition-all duration-200 group-hover:shadow-md"
                                                onclick="return confirmDelete('{{ $user->name }}')">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Mobile View -->
                <div class="lg:hidden">
                    @foreach ($users as $user)
                        <div
                            class="border-b border-gray-100 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                            <div class="px-6 py-5">
                                <!-- User Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-14 w-14 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                            <span class="text-xl font-bold text-white">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $user->role == 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                        {{ $user->role == 'user' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                        {{ !in_array($user->role, ['admin', 'user']) ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>

                                <!-- User Details -->
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 mb-4">
                                    <div class="grid grid-cols-1 gap-3">
                                        <div>
                                            <div
                                                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">
                                                NIK
                                            </div>
                                            <div
                                                class="text-sm font-mono text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-600 px-2 py-1 rounded">
                                                {{ $user->nik }}
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">
                                                Member Since
                                            </div>
                                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                                {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit User
                                    </a>
                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium rounded-lg transition-all duration-200"
                                        onclick="return confirmDelete('{{ $user->name }}')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if ($users->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-300">No users found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding a new user to your
                            team.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        function confirmDelete(userName) {
            return confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`);
        }

        // Simple search functionality
        document.querySelector('input[placeholder="Search users..."]')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr, .lg\\:hidden > div');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
