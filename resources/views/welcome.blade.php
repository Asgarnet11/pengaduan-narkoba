@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-indigo-600 to-blue-500 py-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-500 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-[url('/images/grid.svg')] opacity-20"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                    <span class="block">Sistem Pengaduan</span>
                    <span class="block text-indigo-200">Masyarakat Online</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-indigo-100 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Sampaikan keluhan dan aspirasi Anda dengan mudah, cepat, dan transparan melalui platform pengaduan online kami.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 md:py-4 md:text-lg md:px-10 transition-all duration-300 transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 md:py-4 md:text-lg md:px-10 transition-all duration-300 transform hover:scale-105">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase" data-aos="fade-up">Fitur Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl" data-aos="fade-up" data-aos-delay="100">
                    Solusi Pengaduan Modern
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Kami menyediakan berbagai fitur untuk memudahkan Anda dalam menyampaikan pengaduan.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <!-- Feature 1 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="300">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-paper-plane text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Pengaduan Online</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Sampaikan pengaduan Anda kapan saja dan di mana saja melalui platform online kami.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="400">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Tracking Status</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Pantau status pengaduan Anda secara real-time dengan sistem tracking yang terintegrasi.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="500">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-comments text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Tanggapan Cepat</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Dapatkan tanggapan cepat dari petugas terkait untuk setiap pengaduan yang Anda sampaikan.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="relative" data-aos="fade-up" data-aos-delay="600">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Keamanan Data</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Data pengaduan Anda dilindungi dengan sistem keamanan berlapis dan enkripsi modern.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-indigo-50 pt-12 sm:pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl" data-aos="fade-up">
                    Kepercayaan Masyarakat
                </h2>
                <p class="mt-3 text-xl text-gray-500 sm:mt-4" data-aos="fade-up" data-aos-delay="100">
                    Kami telah melayani ribuan pengaduan dari masyarakat Indonesia
                </p>
            </div>
        </div>
        <div class="mt-10 pb-12 bg-white sm:pb-16">
            <div class="relative">
                <div class="absolute inset-0 h-1/2 bg-indigo-50"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-4xl mx-auto">
                        <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                            <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r" data-aos="fade-up" data-aos-delay="200">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Pengaduan Diproses
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    10K+
                                </dd>
                            </div>
                            <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r" data-aos="fade-up" data-aos-delay="300">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Pengguna Aktif
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    5K+
                                </dd>
                            </div>
                            <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l" data-aos="fade-up" data-aos-delay="400">
                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                    Tingkat Kepuasan
                                </dt>
                                <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                    98%
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl" data-aos="fade-up">
                <span class="block">Siap untuk memulai?</span>
                <span class="block">Daftar sekarang dan sampaikan pengaduan Anda.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200" data-aos="fade-up" data-aos-delay="100">
                Bergabunglah dengan ribuan masyarakat yang telah menggunakan platform kami untuk menyampaikan pengaduan mereka.
            </p>
            <a href="{{ route('register') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // GSAP Animations
    gsap.from(".hero-content", {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: "power3.out"
    });

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Anime.js Animations
    anime({
        targets: '.feature-icon',
        scale: [0, 1],
        opacity: [0, 1],
        delay: anime.stagger(100),
        duration: 1000,
        easing: 'easeOutElastic(1, .5)'
    });
</script>
@endpush
@endsection
