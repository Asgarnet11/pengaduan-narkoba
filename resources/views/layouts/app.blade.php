<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Sistem Pengaduan Masyarakat')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-indigo-600 to-blue-500 shadow-lg" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center group">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                                </div>
                                <span class="ml-2 text-xl font-bold text-white group-hover:text-indigo-100 transition-colors duration-300">PengaduanKu</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-white text-white' : 'border-transparent text-indigo-100 hover:text-white hover:border-white' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                <i class="fas fa-home w-5 h-5 mr-1"></i>
                                Dashboard
                            </a>
                            @auth
                                @if(auth()->user()->isMasyarakat())
                                    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pengaduan.create') ? 'border-white text-white' : 'border-transparent text-indigo-100 hover:text-white hover:border-white' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                        <i class="fas fa-plus w-5 h-5 mr-1"></i>
                                        Buat Pengaduan
                                    </a>
                                    <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pengaduan.index') ? 'border-white text-white' : 'border-transparent text-indigo-100 hover:text-white hover:border-white' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                        <i class="fas fa-list w-5 h-5 mr-1"></i>
                                        Pengaduan Saya
                                    </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-white text-white' : 'border-transparent text-indigo-100 hover:text-white hover:border-white' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                        <i class="fas fa-user-shield w-5 h-5 mr-1"></i>
                                        Dashboard Admin
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @auth
                            <div class="ml-3 relative" x-data="{ open: false }">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-indigo-100 hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                            <div class="flex items-center">
                                                @if(auth()->user()->foto)
                                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-white transform hover:scale-110 transition-transform duration-300">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center transform hover:scale-110 transition-transform duration-300">
                                                        <span class="text-indigo-600 font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                                <span class="ml-2">{{ auth()->user()->name }}</span>
                                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                                            <i class="fas fa-user-circle w-4 h-4 mr-2"></i>
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();"
                                                    class="flex items-center text-red-600">
                                                <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-indigo-100 hover:text-white transition-colors duration-300">
                                <i class="fas fa-sign-in-alt mr-1"></i> Log in
                            </a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-indigo-100 hover:text-white transition-colors duration-300">
                                <i class="fas fa-user-plus mr-1"></i> Register
                            </a>
                        @endauth
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-indigo-100 hover:text-white hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white transition duration-150 ease-in-out">
                            <i class="fas fa-bars w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-home w-5 h-5 mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    @auth
                        @if(auth()->user()->isMasyarakat())
                            <x-responsive-nav-link :href="route('pengaduan.create')" :active="request()->routeIs('pengaduan.create')">
                                <i class="fas fa-plus w-5 h-5 mr-2"></i>
                                {{ __('Buat Pengaduan') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('pengaduan.index')" :active="request()->routeIs('pengaduan.index')">
                                <i class="fas fa-list w-5 h-5 mr-2"></i>
                                {{ __('Pengaduan Saya') }}
                            </x-responsive-nav-link>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                <i class="fas fa-user-shield w-5 h-5 mr-2"></i>
                                {{ __('Dashboard Admin') }}
                            </x-responsive-nav-link>
                        @endif
                    @endauth
                </div>

                <!-- Responsive Settings Options -->
                @auth
                    <div class="pt-4 pb-1 border-t border-indigo-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-indigo-100">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                <i class="fas fa-user-circle w-5 h-5 mr-2"></i>
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt w-5 h-5 mr-2"></i>
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative animate__animated animate__fadeInDown" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative animate__animated animate__fadeInDown" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white mt-8">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
                                <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                            </div>
                            <span class="ml-2 text-xl font-bold">PengaduanKu</span>
                        </div>
                        <p class="mt-4 text-indigo-100">
                            Platform pengaduan masyarakat yang memudahkan warga untuk menyampaikan keluhan dan aspirasi mereka secara online.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold tracking-wider uppercase">Layanan</h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="{{ route('pengaduan.create') }}" class="text-base text-indigo-100 hover:text-white transition-colors duration-300">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    Buat Pengaduan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pengaduan.index') }}" class="text-base text-indigo-100 hover:text-white transition-colors duration-300">
                                    <i class="fas fa-list-alt mr-2"></i>
                                    Lihat Pengaduan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="text-base text-indigo-100 hover:text-white transition-colors duration-300">
                                    <i class="fas fa-user-edit mr-2"></i>
                                    Profil Saya
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold tracking-wider uppercase">Kontak</h3>
                        <ul class="mt-4 space-y-4">
                            <li class="flex items-center text-indigo-100">
                                <i class="fas fa-phone w-5 h-5 mr-2"></i>
                                (021) 1234-5678
                            </li>
                            <li class="flex items-center text-indigo-100">
                                <i class="fas fa-envelope w-5 h-5 mr-2"></i>
                                info@pengaduanku.id
                            </li>
                            <li class="flex items-center text-indigo-100">
                                <i class="fas fa-map-marker-alt w-5 h-5 mr-2"></i>
                                Jl. Contoh No. 123, Jakarta
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-indigo-200 pt-8">
                    <p class="text-center text-indigo-100 text-sm">
                        &copy; {{ date('Y') }} PengaduanKu. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // GSAP Animations
        gsap.from(".navbar", {
            duration: 1,
            y: -50,
            opacity: 0,
            ease: "power3.out"
        });

        // Anime.js Animations
        anime({
            targets: '.footer-item',
            translateY: [20, 0],
            opacity: [0, 1],
            delay: anime.stagger(100),
            duration: 1000,
            easing: 'easeOutElastic(1, .5)'
        });
    </script>

    @stack('scripts')
</body>
</html>

