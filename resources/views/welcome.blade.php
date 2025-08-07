@extends('layouts.app')

@section('title', 'Selamat Datang - Sistem Pengaduan Narkoba Konawe Selatan')

@section('meta')
    <meta name="description"
        content="Platform pengaduan narkoba Konawe Selatan yang aman dan terpercaya. Laporkan kasus narkoba dengan mudah dan pantau progress pengaduan secara real-time.">
    <meta name="keywords" content="pengaduan narkoba, konawe selatan, polres, laporan kriminal, keamanan masyarakat">
    <meta property="og:title" content="Sistem Pengaduan Narkoba Konawe Selatan">
    <meta property="og:description"
        content="Platform pengaduan narkoba yang memudahkan masyarakat melaporkan kasus dan memantau progresnya.">
    <meta property="og:type" content="website">
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="min-h-screen pt-0 bg-gray-50">
        <!-- Hero Section -->
        <section class="relative pt-0 min-h-screen flex items-center justify-center overflow-hidden"
            style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('assets/profil-konsel.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

            <!-- Background Animation Elements -->
            {{-- <div class="absolute inset-0 overflow-hidden">
                <div class="floating-element absolute w-20 h-20 bg-white/10 rounded-full animate-bounce"
                    style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                <div class="floating-element absolute w-16 h-16 bg-blue-300/20 rounded-full animate-pulse"
                    style="top: 60%; right: 15%; animation-delay: 2s;"></div>
                <div class="floating-element absolute w-24 h-24 bg-green-300/20 rounded-full animate-bounce"
                    style="bottom: 20%; left: 20%; animation-delay: 1s;"></div>
            </div> --}}

            <div class="relative z-10 text-center px-4 max-w-6xl mx-auto">
                <!-- Logos Section -->
                {{-- <div class="flex justify-center items-center mb-8 space-x-8 md:space-x-16">
                    <div class="flex flex-col items-center space-y-2">
                        <img src="{{ asset('assets/logo-polres-konsel.png') }}" alt="Logo Polres Konawe Selatan"
                            class="w-16 h-16 md:w-20 md:h-20 object-contain">
                        <span class="text-white text-xs md:text-sm font-medium">Polres Konawe Selatan</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <img src="{{ asset('assets/logo-konsel.png') }}" alt="Logo Konawe Selatan"
                            class="w-16 h-16 md:w-20 md:h-20 object-contain">
                        <span class="text-white text-xs md:text-sm font-medium">Konawe Selatan</span>
                    </div>
                </div> --}}

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Sistem Pengaduan Narkoba
                    <span class="block text-blue-400 mt-2">Konawe Selatan</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Platform pengaduan yang aman dan mudah digunakan untuk melaporkan kasus narkoba
                    serta memantau progress laporan Anda secara real-time.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard Saya</span>
                        </a>
                        <a href="{{ route('pengaduan.create') }}"
                            class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                            <i class="fas fa-plus-circle"></i>
                            <span>Buat Laporan Baru</span>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Mulai Membuat Laporan</span>
                        </a>
                        <a href="{{ route('login') }}"
                            class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk ke Akun</span>
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="mt-1 pt-0 py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Platform Kami?</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Platform yang dirancang khusus untuk kemudahan dan
                        keamanan pelaporan kasus narkoba</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Kerahasiaan Terjamin</h3>
                        <p class="text-gray-600">Data dan identitas pelapor dilindungi dengan sistem keamanan tinggi</p>
                    </div>

                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-green-50 transition-all duration-300 transform hover:scale-105"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="w-16 h-16 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Proses Cepat</h3>
                        <p class="text-gray-600">Laporan Anda akan segera diproses oleh tim yang berpengalaman</p>
                    </div>

                    <div class="text-center p-8 rounded-xl bg-gray-50 hover:bg-purple-50 transition-all duration-300 transform hover:scale-105"
                        data-aos="fade-up" data-aos-delay="300">
                        <div class="w-16 h-16 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pantau Progress</h3>
                        <p class="text-gray-600">Dapatkan update real-time tentang perkembangan laporan Anda</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Kepercayaan Masyarakat</h2>
                    <p class="text-lg text-blue-100 max-w-2xl mx-auto">Data pengaduan yang telah diproses melalui platform
                        kami</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-8" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-number text-4xl md:text-5xl font-bold mb-2" data-target="1245">0</div>
                        <div class="text-blue-100 text-lg">Total Laporan Diterima</div>
                    </div>
                    <div class="text-center p-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-number text-4xl md:text-5xl font-bold mb-2" data-target="156">0</div>
                        <div class="text-blue-100 text-lg">Laporan Sedang Diproses</div>
                    </div>
                    <div class="text-center p-8" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                        <div class="text-blue-100 text-lg">Layanan Tersedia</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/welcome-page.js') }}"></script>
@endpush
