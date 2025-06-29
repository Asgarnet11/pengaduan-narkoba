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
            background: #a7b1d7;
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
            border-top-color: #818cf8 !important;
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
    <x-sidebar :isAdmin="auth()->check() && auth()->user()->isAdmin()" />

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
    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12" data-aos="fade-up" data-aos-duration="1000">
                <!-- Brand -->
                <div class="space-y-4 col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 group">
                        <i
                            class="fas fa-building text-3xl text-indigo-400 group-hover:scale-110 transition-transform duration-300"></i>
                        <h3 class="text-2xl font-bold text-gradient">Pengaduan Masyarakat</h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Platform pengaduan narkoba yang memudahkan antara masyarakat dan kepolisisan untuk
                        pengaduan yang lebih fleksibel dan aman.
                    </p>
                    <div class="flex space-x-4 pt-4">
                        <a href="#"
                            class="text-gray-400 hover:text-white transform hover:scale-110 transition-all duration-300">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transform hover:scale-110 transition-all duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-lg font-semibold">Menu Utama</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('pengaduan.index') }}"
                                class="text-gray-400 hover:text-white flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Pengaduan</span>
                            </a>
                        </li>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <li>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="text-gray-400 hover:text-white flex items-center group">
                                        <i
                                            class="fas fa-chevron-right text-xs mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                        <span>Admin Panel</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg font-semibold">Hubungi Kami</h4>
                    <div class="space-y-3">
                        <p class="flex items-center text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fas fa-map-marker-alt w-6"></i>
                            <span>Jl.lerepako Kec.Laeya Kabupaten Konawe Selatan</span>
                        </p>
                        <p class="flex items-center text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fas fa-phone w-6"></i>
                            <span>+62 123 4567 890</span>
                        </p>
                        <p class="flex items-center text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fas fa-envelope w-6"></i>
                            <span>contact@example.com</span>
                        </p>
                        <p class="flex items-center text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fas fa-clock w-6"></i>
                            <span>Senin - Jumat: 08:00 - 16:00</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8" data-aos="fade-up" data-aos-delay="300">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} Sistem Pengaduan Narkoba. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#"
                            class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Terms of
                            Service</a>
                        <a href="#"
                            class="text-sm text-gray-400 hover:text-white transition-colors duration-300">Contact</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" id="backToTop"
            class="fixed bottom-8 right-8 bg-indigo-600 text-white rounded-full p-3 shadow-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
            <i class="fas fa-arrow-up"></i>
        </button>
    </footer>

    @stack('scripts')

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
</body>

</html>
