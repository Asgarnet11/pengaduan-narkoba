@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome to Section -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-xl overflow-hidden mb-8"
                data-aos="fade-up">
                <div class="px-8 py-12 relative">
                    <!-- Animated Background Particles -->
                    {{-- <div class="absolute inset-0" id="particles"></div> --}}
                    <div>
                        <img src="{{ asset('assets/profil-konsel.png') }}" alt="profil-konsel"
                            class="absolute inset-0 w-full h-full object-cover opacity-20">
                    </div>

                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="animate__animated animate__fadeInLeft">
                                <h2 class="text-3xl font-bold text-white mb-2">
                                    Selamat {{ $greeting }}, {{ Auth::user()->name }}!
                                </h2>
                                <p class="text-indigo-100">Selamat datang di Dashboard Pengaduan Narkoba</p>
                            </div>
                            <div class="hidden md:block animate__animated animate__fadeInRight">
                                <img src="assets/complaint1.svg" alt="Dashboard Hero" class="w-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Pengaduan -->
                <div class="hover-card bg-white rounded-xl p-6 shadow-lg transition-all duration-300" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                            <i class="fas fa-clipboard-list text-2xl text-indigo-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Pengaduan</p>
                            <h3 class="text-2xl font-bold text-gray-900" id="total-counter">{{ $totalPengaduan }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Diproses -->
                <div class="hover-card bg-white rounded-xl p-6 shadow-lg transition-all duration-300" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                            <i class="fas fa-clock text-2xl text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                            <h3 class="text-2xl font-bold text-gray-900" id="process-counter">{{ $pengaduanProses }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Selesai -->
                <div class="hover-card bg-white rounded-xl p-6 shadow-lg transition-all duration-300" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                            <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Selesai</p>
                            <h3 class="text-2xl font-bold text-gray-900" id="complete-counter">{{ $pengaduanSelesai }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Ditolak -->
                <div class="hover-card bg-white rounded-xl p-6 shadow-lg transition-all duration-300" data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                            <i class="fas fa-times-circle text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Ditolak</p>
                            <h3 class="text-2xl font-bold text-gray-900" id="rejected-counter">{{ $pengaduanDitolak }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Pengaduan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">Pengaduan Terbaru</h2>
                        <a href="{{ route('pengaduan.create') }}"
                            class="btn-primary inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Pengaduan
                        </a>
                    </div>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($recentPengaduan as $pengaduan)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="inline-block mb-2">
                                        <h3
                                            class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                                            {{ $pengaduan->judul }}
                                        </h3>
                                    </a>
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <span class="flex items-center">
                                            <i class="far fa-calendar mr-2"></i>
                                            {{ $pengaduan->created_at->format('d M Y H:i') }}
                                        </span>
                                        <span class="mx-2">•</span>
                                        <span class="flex items-center">
                                            <i class="far fa-folder mr-2"></i>
                                            {{ $pengaduan->kategori->nama }}
                                        </span>
                                        <span class="mx-2">•</span>
                                        <span class="flex items-center">
                                            <img class="h-5 w-5 rounded-full object-cover mr-2"
                                                src="{{ $pengaduan->user->getProfilePhotoUrl() }}"
                                                alt="{{ $pengaduan->user->name }}">
                                            {{ $pengaduan->user->name }}
                                            @if ($pengaduan->user_id === Auth::id())
                                                <span
                                                    class="ml-1 px-2 py-0.5 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">Anda</span>
                                            @endif
                                        </span>
                                    </div>
                                    <p class="text-gray-600 line-clamp-2">{{ $pengaduan->isi }}</p>
                                </div>
                                <div class="ml-6">
                                    <span @class([
                                        'px-3 py-1 text-xs font-semibold rounded-full',
                                        'bg-gray-100 text-gray-800' => $pengaduan->status === 'pending',
                                        'bg-yellow-100 text-yellow-800' => $pengaduan->status === 'proses',
                                        'bg-green-100 text-green-800' => $pengaduan->status === 'selesai',
                                        'bg-red-100 text-red-800' => $pengaduan->status === 'ditolak',
                                    ])>
                                        {{ ucfirst($pengaduan->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-comment mr-2"></i>
                                    {{ $pengaduan->tanggapan->count() }} Tanggapan
                                </div>
                                <a href="{{ route('pengaduan.show', $pengaduan->id) }}"
                                    class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors duration-200">
                                    Lihat Detail
                                    <i
                                        class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-200"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center" data-aos="fade-up">
                            <img src="https://illustrations.popsy.co/gray/falling-box.svg" alt="No Data"
                                class="w-48 mx-auto mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengaduan</h3>
                            <p class="text-gray-500 mb-6">Anda belum membuat pengaduan apapun.</p>
                            <a href="{{ route('pengaduan.create') }}"
                                class="btn-primary inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-plus mr-2"></i>
                                Buat Pengaduan Pertama
                            </a>
                        </div>
                    @endforelse
                </div>

                @if ($recentPengaduan->count() > 0)
                    <div class="p-6 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('pengaduan.index') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors duration-200">
                            Lihat Semua Pengaduan
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Particle Animation for Welcome Section
            const particlesContainer = document.getElementById('particles');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-2 h-2 bg-white rounded-full opacity-20';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particlesContainer.appendChild(particle);
            }

            anime({
                targets: '#particles div',
                translateX: () => anime.random(-20, 20),
                translateY: () => anime.random(-20, 20),
                scale: () => anime.random(1, 1.5),
                opacity: () => anime.random(0.1, 0.3),
                duration: 3000,
                easing: 'easeInOutQuad',
                loop: true,
                delay: anime.stagger(100),
                direction: 'alternate'
            });

            // Counter Animation
            function animateCounter(elementId, targetValue) {
                const obj = {
                    count: 0
                };
                const element = document.getElementById(elementId);

                anime({
                    targets: obj,
                    count: targetValue,
                    round: 1,
                    duration: 2000,
                    easing: 'easeInOutQuad',
                    update: function() {
                        element.innerHTML = obj.count;
                    }
                });
            }

            // Initialize counters when they come into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const elementId = entry.target.id;
                        const value = parseInt(entry.target.innerText);
                        animateCounter(elementId, value);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            // Observe all counter elements
            ['total-counter', 'process-counter', 'complete-counter', 'rejected-counter'].forEach(id => {
                const element = document.getElementById(id);
                if (element) observer.observe(element);
            });

            // Hover card animations
            document.querySelectorAll('.hover-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    anime({
                        targets: card,
                        scale: 1.03,
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

            // GSAP Animations
            gsap.registerPlugin(ScrollTrigger);

            gsap.from('.hover-card', {
                scrollTrigger: {
                    trigger: '.hover-card',
                    start: 'top bottom-=100',
                    toggleActions: 'play none none reverse'
                },
                y: 30,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out'
            });
        </script>
    @endpush
@endsection
