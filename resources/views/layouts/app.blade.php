<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Sistem Informasi Pengaduan Narkoba - Platform pengaduan narkoba yang efektif dan aman untuk masyarakat.">
    <meta name="theme-color" content="#2563eb">
    <title>@yield('title', 'Sistem Pengaduan Masyarakat')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'bounce-slow': 'bounce 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- AOS - Animate on Scroll -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Loading Bar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.css">
    <script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js"></script>

    {{-- Maps Leaflet JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #5f5f61;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #5060f0;
        }

        /* Card Hover Effects */
        .hover-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Button Hover Effects */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transform: translateX(-100%);
            transition: 0.5s;
        }

        .btn-primary:hover::after {
            transform: translateX(100%);
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        /* Loading Bar Customization */
        #nprogress .bar {
            background: linear-gradient(to right, #818cf8, #6366f1) !important;
            height: 3px !important;
        }

        #nprogress .spinner-icon {
            border-top-color: #474851 !important;
            border-left-color: #6366f1 !important;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            right: 1rem;
            top: 1rem;
            z-index: 50;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(120deg, #6366f1, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <x-navigation :isAdmin="auth()->check() && auth()->user()->isAdmin()" />

    <!-- Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" @click="show = false"
            class="toast animate__animated animate__fadeInRight cursor-pointer">
            <div class="bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3">
                <i class="fas fa-check-circle text-xl"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" @click="show = false"
            class="toast animate__animated animate__fadeInRight cursor-pointer">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-xl"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen py-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-shield-alt text-3xl text-indigo-400"></i>
                        <h3 class="text-2xl font-bold">SI Pengaduan Narkoba</h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed text-sm">
                        Platform pelaporan yang aman dan rahasia untuk mendukung upaya pemberantasan narkoba di
                        Kabupaten Konawe Selatan.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                                class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                                class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                                class="fab fa-twitter text-xl"></i></a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-md font-semibold tracking-wider uppercase text-gray-300">Menu Utama</h4>
                        <ul class="mt-4 space-y-3">
                            <li><a href=""
                                    class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Beranda</a>
                            </li>
                            <li><a href="{{ route('pengaduan.create') }}"
                                    class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Buat
                                    Laporan</a></li>
                            @auth
                                <li><a href="{{ route('dashboard') }}"
                                        class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Dashboard
                                        Saya</a></li>
                                @if (auth()->user()->isAdmin())
                                    <li><a href="{{ route('admin.dashboard') }}"
                                            class="text-sm text-indigo-400 hover:text-white transition-colors duration-300">Panel
                                            Admin</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold tracking-wider uppercase text-gray-300">Kontak</h4>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt w-5 mt-1 text-gray-400"></i>
                                <span class="ml-2 text-sm text-gray-400">Jl. Poros Kendari - Andoolo Km.61, Kab. Konawe
                                    Selatan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-phone w-5 mt-1 text-gray-400"></i>
                                <span class="ml-2 text-sm text-gray-400">+62 123 4567 890</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <h4 class="text-md font-semibold tracking-wider uppercase text-gray-300">Lokasi Polres Konawe
                        Selatan</h4>
                    <div id="footer-map" class="mt-4 h-40 w-full rounded-lg border-2 border-gray-700"></div>
                </div>
            </div>

            <div class="mt-12 border-t border-gray-800 pt-8">
                <p class="text-sm text-gray-400 text-center">&copy; {{ date('Y') }} SI Pengaduan Narkoba. All Rights
                    Reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Handle Back to Top button visibility
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
                backToTop.classList.remove('opacity-100', 'visible');
            }
        });

        // Initialize AOS with custom settings
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Loading Bar Configuration
        NProgress.configure({
            showSpinner: false,
            minimum: 0.1,
            easing: 'ease',
            speed: 500
        });

        // Show loading bar on navigation
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    if (link.href && !link.href.includes('#') && !link.href.includes(
                            'javascript:')) {
                        NProgress.start();
                    }
                });
            });

            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', () => {
                    NProgress.start();
                });
            });

            // Initialize card animations
            setupCardAnimations();
        });

        // Card hover animations
        function setupCardAnimations() {
            const cards = document.querySelectorAll('.hover-card');

            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    anime({
                        targets: card,
                        translateY: -5,
                        boxShadow: ['0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                            '0 20px 25px -5px rgba(0, 0, 0, 0.1)'
                        ],
                        duration: 300,
                        easing: 'easeOutElastic(1, .8)'
                    });
                });

                card.addEventListener('mouseleave', () => {
                    anime({
                        targets: card,
                        translateY: 0,
                        boxShadow: ['0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                            '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                        ],
                        duration: 300,
                        easing: 'easeOutElastic(1, .8)'
                    });
                });
            });
        }

        // GSAP ScrollTrigger Animations
        gsap.utils.toArray('.fade-in-up').forEach(element => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom-=100',
                    toggleActions: 'play none none reverse'
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        });

        // Enhanced Toast Notifications
        @if (session('success') || session('error'))
            anime({
                targets: '.toast',
                translateX: [-100, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutElastic(1, .8)'
            });
        @endif
    </script>
    <script>
        // Konfigurasi peta
        const MAP_CONFIG = {
            // Koordinat Polres Konawe Selatan (mohon verifikasi koordinat yang tepat)
            polresCoords: [-4.1325, 122.4567],
            zoom: 15,
            popupText: '<b>Polres Konawe Selatan</b><br>Jl. Poros Kendari - Andoolo Km.61, Kab. Konawe Selatan',
            attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
        };

        // Fungsi untuk inisialisasi peta
        function initializeFooterMap() {
            try {
                // Cek apakah Leaflet sudah dimuat
                if (typeof L === 'undefined') {
                    console.error('Leaflet library tidak ditemukan. Pastikan sudah dimuat sebelum script ini.');
                    return;
                }

                const mapElement = document.getElementById('footer-map');
                if (!mapElement) {
                    console.warn('Element #footer-map tidak ditemukan di halaman ini.');
                    return;
                }

                // Tambahkan loading indicator
                mapElement.innerHTML =
                    '<div style="display: flex; justify-content: center; align-items: center; height: 100%; color: #666;"><span>Memuat peta...</span></div>';

                // Inisialisasi peta dengan konfigurasi yang dioptimalkan
                const footerMap = L.map('footer-map', {
                    center: MAP_CONFIG.polresCoords,
                    zoom: MAP_CONFIG.zoom,
                    // Menonaktifkan semua interaksi pengguna untuk peta footer
                    dragging: false,
                    touchZoom: false,
                    doubleClickZoom: false,
                    scrollWheelZoom: false,
                    boxZoom: false,
                    keyboard: false,
                    zoomControl: false,
                    attributionControl: true // Tetap tampilkan attribution untuk compliance
                });

                // Menggunakan tile layer yang ringan dan cepat
                const tileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: MAP_CONFIG.attribution,
                    maxZoom: 19,
                    subdomains: 'abcd'
                });

                // Event handler untuk tile loading
                tileLayer.on('loading', function() {
                    console.log('Memuat tiles peta...');
                });

                tileLayer.on('load', function() {
                    console.log('Peta berhasil dimuat');
                });

                tileLayer.on('tileerror', function(error) {
                    console.error('Error memuat tile peta:', error);
                });

                tileLayer.addTo(footerMap);

                // Buat custom icon untuk marker (opsional)
                const policeIcon = L.divIcon({
                    html: '<div style="background-color: #1e40af; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"><i class="fas fa-shield-alt" style="font-size: 14px;"></i></div>',
                    className: 'custom-marker',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15],
                    popupAnchor: [0, -15]
                });

                // Menambahkan marker dengan popup
                const marker = L.marker(MAP_CONFIG.polresCoords, {
                    icon: policeIcon // Hapus ini jika tidak menggunakan custom icon
                }).addTo(footerMap);

                // Popup dengan informasi lebih detail
                marker.bindPopup(MAP_CONFIG.popupText, {
                    closeButton: false,
                    offset: L.point(0, -10)
                });

                // Buka popup secara otomatis (opsional)
                marker.openPopup();

                // Tambahkan event listener untuk resize window
                window.addEventListener('resize', function() {
                    setTimeout(function() {
                        footerMap.invalidateSize();
                    }, 100);
                });

                console.log('Footer map berhasil diinisialisasi');

            } catch (error) {
                console.error('Error saat inisialisasi peta:', error);

                // Tampilkan pesan error yang user-friendly
                const mapElement = document.getElementById('footer-map');
                if (mapElement) {
                    mapElement.innerHTML =
                        '<div style="display: flex; justify-content: center; align-items: center; height: 100%; color: #666; text-align: center;"><div><i class="fas fa-map-marker-alt"></i><br>Peta tidak dapat dimuat<br><small>Mohon refresh halaman</small></div></div>';
                }
            }
        }

        // Inisialisasi peta HANYA jika elemen #footer-map ada di halaman
        if (document.getElementById('footer-map')) {
            // Cek apakah DOM sudah siap
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeFooterMap);
            } else {
                // DOM sudah siap, langsung jalankan
                initializeFooterMap();
            }
        }

        // Export untuk penggunaan di tempat lain jika diperlukan
        window.MapUtils = {
            initializeFooterMap: initializeFooterMap,
            MAP_CONFIG: MAP_CONFIG
        };
    </script>
</body>

</html>
