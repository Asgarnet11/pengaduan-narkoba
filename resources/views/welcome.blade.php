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
    <link rel="stylesheet" href="{{ asset('css/welcome-page.css') }}">
@endpush

@section('content')
    <div class="welcome-container">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-logo">
                    <img src="/assets/logo-konsel.png" alt="Logo Polres Konawe Selatan" class="logo-img">
                </div>

                <h1 class="hero-title">
                    Sistem Pengaduan Narkoba
                    <span class="hero-highlight">Konawe Selatan</span>
                </h1>

                <p class="hero-description">
                    Platform pengaduan yang aman dan mudah digunakan untuk melaporkan kasus narkoba
                    serta memantau progress laporan Anda secara real-time.
                </p>

                <div class="hero-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            Dashboard Saya
                        </a>
                        <a href="{{ route('pengaduan.create') }}" class="btn btn-secondary">
                            Buat Laporan Baru
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Mulai Membuat Laporan
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            Masuk ke Akun
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Fitur Utama -->
        <section class="features-section">
            <div class="section-header">
                <h2>Mengapa Memilih Platform Kami?</h2>
                <p>Platform yang dirancang khusus untuk kemudahan dan keamanan pelaporan kasus narkoba</p>
            </div>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3>Kerahasiaan Terjamin</h3>
                    <p>Data dan identitas pelapor dilindungi dengan sistem keamanan tinggi</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3>Proses Cepat</h3>
                    <p>Laporan Anda akan segera diproses oleh tim yang berpengalaman</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3>Pantau Progress</h3>
                    <p>Dapatkan update real-time tentang perkembangan laporan Anda</p>
                </div>
            </div>
        </section>

        <!-- Statistik -->
        <section class="stats-section">
            <div class="section-header">
                <h2>Kepercayaan Masyarakat</h2>
                <p>Data pengaduan yang telah diproses melalui platform kami</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">1,245</div>
                    <div class="stat-label">Total Laporan Diterima</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">156</div>
                    <div class="stat-label">Laporan Sedang Diproses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Tersedia</div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>Siap Membuat Laporan?</h2>
                <p>Mari bersama-sama menciptakan Konawe Selatan yang bebas dari narkoba</p>
                @auth
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-cta">
                        Buat Laporan Sekarang
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-cta">
                        Bergabung Sekarang
                    </a>
                @endauth
            </div>
        </section>
    </div>

@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/form-peta.js') }}"></script>
@endpush
@push('scripts')
    <script src="{{ asset('js/form-peta.js') }}"></script>
@endpush
