@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6" data-aos="fade-up">
            <div class="p-6 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                <div class="flex items-center">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="{{ auth()->user()->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-white">
                    @else
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold">Selamat {{ $greeting }}, {{ auth()->user()->name }}!</h2>
                        <p class="text-indigo-100">Selamat datang kembali di dashboard Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Pengaduan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                            <i class="fas fa-file-alt text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Pengaduan</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalPengaduan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengaduan Proses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pengaduanProses }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengaduan Selesai -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Selesai</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pengaduanSelesai }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengaduan Ditolak -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-times-circle text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Ditolak</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pengaduanDitolak }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Pengaduan -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="500">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Pengaduan Terbaru</h3>
                    <a href="{{ route('pengaduan.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentPengaduan as $pengaduan)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $pengaduan->judul }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $pengaduan->created_at->format('d M Y H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($pengaduan->status === 'selesai')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                        @elseif($pengaduan->status === 'proses')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                        @elseif($pengaduan->status === 'ditolak')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($pengaduan->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('pengaduan.show', $pengaduan) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada pengaduan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Buat Pengaduan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="600">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Buat Pengaduan Baru</h3>
                    <p class="text-gray-500 mb-4">Sampaikan keluhan atau aspirasi Anda dengan mudah dan cepat.</p>
                    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Pengaduan
                    </a>
                </div>
            </div>

            <!-- Panduan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-aos="fade-up" data-aos-delay="700">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan Pengaduan</h3>
                    <p class="text-gray-500 mb-4">Pelajari cara membuat pengaduan yang efektif dan informatif.</p>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-book mr-2"></i>
                        Lihat Panduan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // GSAP Animations
    gsap.from(".welcome-section", {
        duration: 1,
        y: 30,
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
        targets: '.stat-card',
        scale: [0.9, 1],
        opacity: [0, 1],
        delay: anime.stagger(100),
        duration: 1000,
        easing: 'easeOutElastic(1, .5)'
    });
</script>
@endpush
@endsection
