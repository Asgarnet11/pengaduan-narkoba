{{-- resources/views/components/navigation.blade.php --}}
@props(['isAdmin' => false])

<nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 shadow-2xl border-b-4 border-yellow-400 sticky top-0 z-50 backdrop-blur-sm"
    x-data="{ open: false, profileOpen: false }" @click.away="profileOpen = false">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="flex-shrink-0 flex items-center space-x-4">
                <a href="/" class="flex items-center space-x-3 group">
                    <!-- Logo Polres -->
                    <div class="relative">
                        <img src="{{ asset('assets/logo-polres.png') }}" alt="Logo Polres Konawe Selatan"
                            class="h-14 w-14 object-contain transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-yellow-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Logo Konawe Selatan -->
                    <div class="relative">
                        <img src="{{ asset('assets/logo-konsel.png') }}" alt="Logo Konawe Selatan"
                            class="h-14 w-14 object-contain transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-yellow-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="hidden lg:block">
                        <div class="text-white font-bold text-lg leading-tight">
                            <span class="block text-yellow-300 font-display">POLRES KONAWE SELATAN</span>
                            <span class="block text-sm font-medium text-blue-200">Sistem Pengaduan Narkoba</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-1">
                    <!-- Home -->
                    <a href="/"
                        class="px-4 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300 flex items-center space-x-2 font-medium {{ request()->routeIs('welcome') ? 'bg-blue-700 text-white shadow-lg' : '' }}">
                        <i class="fas fa-home text-sm"></i>
                        <span>Beranda</span>
                    </a>

                    @auth
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300 flex items-center space-x-2 font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white shadow-lg' : '' }}">
                            <i class="fas fa-tachometer-alt text-sm"></i>
                            <span>Dashboard</span>
                        </a>

                        <!-- Create Report -->
                        <a href="{{ route('pengaduan.create') }}"
                            class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 font-medium shadow-lg {{ request()->routeIs('pengaduan.create') ? 'from-red-700 to-red-800' : '' }}">
                            <i class="fas fa-exclamation-triangle text-sm"></i>
                            <span>Buat Laporan</span>
                        </a>

                        @if ($isAdmin)
                            <!-- Admin Panel -->
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-4 py-2 rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 font-bold shadow-lg {{ request()->routeIs('admin.*') ? 'from-yellow-600 to-yellow-700' : '' }}">
                                <i class="fas fa-shield-alt text-sm"></i>
                                <span>Panel Petugas</span>
                            </a>
                        @endif
                    @else
                        <!-- Login -->
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300 flex items-center space-x-2 font-medium">
                            <i class="fas fa-sign-in-alt text-sm"></i>
                            <span>Masuk</span>
                        </a>

                        <!-- Register -->
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 rounded-lg bg-gradient-to-r from-green-600 to-green-700 text-white hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 font-medium shadow-lg">
                            <i class="fas fa-user-plus text-sm"></i>
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- User Menu (Desktop) -->
            @auth
                <div class="hidden md:block relative">
                    <div class="flex items-center space-x-4">
                        <!-- Police Badge Indicator -->
                        <div class="flex items-center space-x-2 px-3 py-1 bg-blue-800/50 rounded-full">
                            <i class="fas fa-badge text-yellow-400 text-sm"></i>
                            <span class="text-blue-100 text-sm font-medium">
                                {{ $isAdmin ? 'Petugas' : 'Masyarakat' }}
                            </span>
                        </div>

                        <!-- Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center space-x-2 px-3 py-2 bg-blue-700/50 hover:bg-blue-700 rounded-lg transition-all duration-300 text-white">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user text-blue-900 text-sm"></i>
                                </div>
                                <span class="font-medium text-sm">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                                    :class="{ 'rotate-180': open }"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">

                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                    <i class="fas fa-user-edit w-4"></i>
                                    <span>Edit Profil</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center space-x-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt w-4"></i>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-2">
                @auth
                    <!-- Mobile Police Badge -->
                    <div class="flex items-center space-x-1 px-2 py-1 bg-blue-800/50 rounded-full">
                        <i class="fas fa-badge text-yellow-400 text-xs"></i>
                        <span class="text-blue-100 text-xs">{{ $isAdmin ? 'Petugas' : 'Masyarakat' }}</span>
                    </div>
                @endauth

                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-white bg-blue-700/50 hover:bg-blue-700 transition-colors duration-200"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-lg" x-show="!open"></i>
                    <i class="fas fa-times text-lg" x-show="open" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden bg-blue-900/95 backdrop-blur-sm border-t border-blue-700" id="mobile-menu" x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" x-cloak>

        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Mobile Logo Title -->
            <div class="flex items-center justify-center space-x-2 px-3 py-2 mb-4">
                <img src="{{ asset('assets/logo-polres.png') }}" alt="Polres" class="h-8 w-8 object-contain">
                <span class="text-yellow-300 font-bold text-sm">POLRES KONAWE SELATAN</span>
                <img src="{{ asset('assets/logo-konsel.png') }}" alt="Konsel" class="h-8 w-8 object-contain">
            </div>

            <a href="/"
                class="flex items-center space-x-3 px-3 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300 {{ request()->routeIs('welcome') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fas fa-home w-5"></i>
                <span>Beranda</span>
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('pengaduan.create') }}"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-all duration-300">
                    <i class="fas fa-exclamation-triangle w-5"></i>
                    <span>Buat Laporan</span>
                </a>

                @if ($isAdmin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-yellow-500 text-gray-900 hover:bg-yellow-600 transition-all duration-300 font-bold">
                        <i class="fas fa-shield-alt w-5"></i>
                        <span>Panel Petugas</span>
                    </a>
                @endif

                <!-- Mobile User Info -->
                <div class="border-t border-blue-700 mt-4 pt-4">
                    <div class="flex items-center space-x-3 px-3 py-2 mb-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-900"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-blue-200 text-sm">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300">
                        <i class="fas fa-user-edit w-5"></i>
                        <span>Edit Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-3 w-full px-3 py-2 rounded-lg text-red-300 hover:bg-red-800/50 hover:text-red-200 transition-all duration-300">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg text-blue-100 hover:bg-blue-700 hover:text-white transition-all duration-300">
                    <i class="fas fa-sign-in-alt w-5"></i>
                    <span>Masuk</span>
                </a>

                <a href="{{ route('register') }}"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-all duration-300">
                    <i class="fas fa-user-plus w-5"></i>
                    <span>Daftar</span>
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Police Stripe Decoration -->
<div class="h-1 bg-gradient-to-r from-yellow-400 via-yellow-300 to-yellow-400"></div>
