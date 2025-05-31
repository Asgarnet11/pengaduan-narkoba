@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="mt-1 text-base text-gray-500">Kelola semua pengaduan dan kategori di satu tempat.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md">
                    <i class="fas fa-tags mr-2"></i>
                    Kelola Kategori
                </a>
                <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Pengaduan
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Pengaduan -->
        <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md p-6 transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <i class="fas fa-clipboard-list text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Pengaduan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Pengaduan Menunggu -->
        <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md p-6 transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Menunggu</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['terkirim'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Pengaduan Diproses -->
        <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md p-6 transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-cogs text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Diproses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['diproses'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Pengaduan Selesai -->
        <div class="stat-card bg-white rounded-xl shadow-sm hover:shadow-md p-6 transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Selesai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['selesai'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <h2 class="text-xl font-semibold text-gray-900">Daftar Pengaduan</h2>
            <div class="flex flex-col sm:flex-row gap-4">
                <select id="statusFilter" class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500 min-w-[150px]">
                    <option value="">Semua Status</option>
                    <option value="terkirim">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <select id="kategoriFilter" class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500 min-w-[150px]">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Daftar Pengaduan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($pengaduan as $item)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md p-6 transition-all duration-300" data-aos="fade-up">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                        <a href="{{ route('admin.pengaduan.show', $item->id) }}">{{ $item->judul }}</a>
                    </h3>
                    <span @class([
                        'px-3 py-1 text-xs font-semibold rounded-full inline-flex items-center',
                        'bg-yellow-100 text-yellow-800' => $item->status === 'terkirim',
                        'bg-blue-100 text-blue-800' => $item->status === 'diproses',
                        'bg-green-100 text-green-800' => $item->status === 'selesai',
                        'bg-red-100 text-red-800' => $item->status === 'ditolak',
                    ])>
                        @if($item->status === 'terkirim')
                            <i class="fas fa-clock mr-1.5"></i>
                        @elseif($item->status === 'diproses')
                            <i class="fas fa-cogs mr-1.5"></i>
                        @elseif($item->status === 'selesai')
                            <i class="fas fa-check-circle mr-1.5"></i>
                        @else
                            <i class="fas fa-times-circle mr-1.5"></i>
                        @endif
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                    <span class="flex items-center">
                        <img class="h-6 w-6 rounded-full object-cover mr-2"
                             src="{{ $item->user->getProfilePhotoUrl() }}"
                             alt="{{ $item->user->name }}'s Avatar">
                        {{ $item->user->name }}
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-folder mr-2"></i>
                        {{ $item->kategori->nama }}
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        {{ $item->created_at->format('d M Y') }}
                    </span>
                </div>

                <p class="text-gray-600 mb-4 line-clamp-2">{{ $item->isi }}</p>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500 flex items-center">
                        <i class="far fa-comment mr-2"></i>
                        {{ $item->tanggapan->count() }} Tanggapan
                    </span>
                    <div class="flex space-x-3">
                        <form action="{{ route('admin.pengaduan.update-status', $item->id) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" class="rounded-lg border-gray-300 text-sm text-gray-700 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="terkirim" {{ $item->status === 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                                <option value="diproses" {{ $item->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $item->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="ml-2 px-3 py-1.5 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-lg hover:bg-yellow-200 transition-colors">
                                <i class="fas fa-sync-alt mr-1.5"></i>
                                Update
                            </button>
                        </form>
                        <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                            Detail
                            <i class="fas fa-chevron-right ml-1.5 text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-inbox text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada pengaduan</h3>
                    <p class="text-gray-500">Pengaduan yang masuk akan muncul di sini</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($pengaduan->hasPages())
        <div class="mt-8">
            {{ $pengaduan->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    // GSAP Animations
    gsap.from(".stat-card", {
        scrollTrigger: {
            trigger: ".stat-card",
            start: "top bottom-=100",
            toggleActions: "play none none reverse"
        },
        duration: 1,
        y: 20,
        opacity: 0,
        stagger: 0.2,
        ease: "power3.out"
    });

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Anime.js Animations for cards
    anime({
        targets: '.pengaduan-card',
        scale: [0.95, 1],
        opacity: [0, 1],
        delay: anime.stagger(100),
        duration: 800,
        easing: 'easeOutElastic(1, .5)'
    });

    // Filter functionality

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        applyFilters();
    });

    document.getElementById('kategoriFilter').addEventListener('change', function() {
        applyFilters();
    });

    function applyFilters() {
        const status = document.getElementById('statusFilter').value;
        const kategori = document.getElementById('kategoriFilter').value;

        location.href = `/admin/pengaduan?status=${status}&kategori=${kategori}`;
    }
</script>
@endpush
@endsection
