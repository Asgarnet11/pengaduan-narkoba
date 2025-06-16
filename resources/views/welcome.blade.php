@extends('layouts.app')

@section('title', 'Selamat Datang - Sistem Pengaduan Narkoba Konawe Selatan')

@section('content')
    <div class="relative mt-0">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-indigo-200 to-blue-100 bg-opacity-40 overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('/assets/profil-konsel.jpg'); opacity: 0.10;"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="text-center lg:text-left" data-aos="fade-right">
                        <h1
                            class="text-xl md:text-5xl lg:text-6xl font-bold text-indigo-500 mb-6 animate__animated animate__fadeInUp">
                            Suara Anda Penting
                            <br>untuk Konawe Selatan Yang Lebih Baik
                        </h1>
                        <p
                            class="text-lg md:text-xl font-semibold text-gray-400 mb-8 animate__animated animate__fadeInUp animate__delay-1s">
                            Platform pengaduan narkoba yang memudahkan antara masyarakat dan kepolisisan untuk
                            pengaduan yang lebih fleksibel dan aman.
                        </p>
                        <div class="space-x-4  animate__animated animate__fadeInUp animate__delay-2s">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-50 transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-50 transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}"
                                    class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-800 bg-opacity-50 hover:bg-opacity-70 transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="hidden lg:block" data-aos="fade-left">
                        <img src="assets/complaint1.svg" alt="Hero Illustration"
                            class="w-60 max-w-xs mx-auto transform hover:scale-105 transition-transform duration-500 animate__animated animate__fadeInRight">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Beberapa fitur yang memudahkan Anda dalam
                        menyampaikan pengaduan dan memantau progresnya.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="hover-card bg-white rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 animate-float">
                            <i class="fas fa-comments text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Pengaduan Mudah</h3>
                        <p class="text-gray-600">Sampaikan pengaduan Anda dengan mudah dan cepat melalui platform kami.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="hover-card bg-white rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 animate-float">
                            <i class="fas fa-chart-line text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tracking Realtime</h3>
                        <p class="text-gray-600">Pantau status pengaduan Anda secara realtime dengan mudah.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="hover-card bg-white rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 animate-float">
                            <i class="fas fa-shield-alt text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Privasi Terjamin</h3>
                        <p class="text-gray-600">Data pengaduan Anda akan dijaga kerahasiaannya dengan baik.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-indigo-50 py-20" data-aos="fade-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-indigo-600 mb-2 counter" data-target="1000">0</div>
                        <p class="text-gray-600">Total Pengaduan</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-indigo-600 mb-2 counter" data-target="850">0</div>
                        <p class="text-gray-600">Pengaduan Selesai</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-indigo-600 mb-2 counter" data-target="100">0</div>
                        <p class="text-gray-600">Pengaduan Aktif</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-indigo-600 mb-2 counter" data-target="500">0</div>
                        <p class="text-gray-600">Pengguna Aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="relative bg-indigo-700 py-20">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-800 to-indigo-700 opacity-90"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-8">
                    Siap Menyampaikan Pengaduan?
                </h2>
                <div class="inline-flex rounded-md shadow">
                    @auth
                        <a href="{{ route('pengaduan.create') }}"
                            class="btn-primary inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-50 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Buat Pengaduan
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="btn-primary inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-50 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Animated Background with Anime.js
            const bg = document.getElementById('animated-bg');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-2 h-2 bg-white rounded-full opacity-20';
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = Math.random() * 100 + '%';
                bg.appendChild(particle);
            }

            anime({
                targets: '#animated-bg div',
                translateY: function() {
                    return anime.random(-200, 200);
                },
                translateX: function() {
                    return anime.random(-200, 200);
                },
                scale: function() {
                    return anime.random(1, 3);
                },
                easing: 'easeInOutQuad',
                duration: 5000,
                delay: anime.stagger(100),
                loop: true,
                direction: 'alternate'
            });

            // Counter Animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                // Start counter animation when element is in view
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                });

                observer.observe(counter);
            });

            // GSAP Animations
            gsap.from(".hero-content", {
                duration: 1,
                y: 50,
                opacity: 0,
                ease: "power3.out",
                stagger: 0.2
            });

            // Feature cards animation on hover
            document.querySelectorAll('.hover-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    anime({
                        targets: card,
                        scale: 1.05,
                        boxShadow: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                        duration: 400,
                        easing: 'easeOutElastic(1, .8)'
                    });
                });

                card.addEventListener('mouseleave', () => {
                    anime({
                        targets: card,
                        scale: 1,
                        boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        duration: 400,
                        easing: 'easeOutElastic(1, .8)'
                    });
                });
            });
        </script>
    @endpush
@endsection
