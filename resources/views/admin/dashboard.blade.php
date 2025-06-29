@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola semua pengaduan dan kategori di satu tempat</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('admin.kategori.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            Kelola Kategori
                        </a>
                        <a href="{{ route('pengaduan.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Pengaduan -->
                <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pengaduan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Menunggu -->
                <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['terkirim'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Diproses -->
                <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Diproses</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['diproses'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Selesai -->
                <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['selesai'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 sm:mb-0">Daftar Pengaduan</h2>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select id="statusFilter"
                            class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Semua Status</option>
                            <option value="terkirim">Menunggu</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <select id="kategoriFilter"
                            class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Pengaduan List -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @forelse($pengaduan as $item)
                    <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <!-- Header -->
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                                    <a href="{{ route('admin.pengaduan.show', $item->id) }}">{{ $item->judul }}</a>
                                </h3>
                                <span @class([
                                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                    'bg-yellow-100 text-yellow-800' => $item->status === 'terkirim',
                                    'bg-blue-100 text-blue-800' => $item->status === 'diproses',
                                    'bg-green-100 text-green-800' => $item->status === 'selesai',
                                    'bg-red-100 text-red-800' => $item->status === 'ditolak',
                                ])>
                                    @if ($item->status === 'terkirim')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($item->status === 'diproses')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($item->status === 'selesai')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($item->status === 'terkirim' ? 'Menunggu' : $item->status) }}
                                </span>
                            </div>

                            <!-- Meta Information -->
                            <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                                <div class="flex items-center">
                                    <img class="h-5 w-5 rounded-full mr-2" src="{{ $item->user->getProfilePhotoUrl() }}"
                                        alt="{{ $item->user->name }}">
                                    {{ $item->user->name }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m7 7 5 5 5-5"></path>
                                    </svg>
                                    {{ $item->kategori->nama }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4V9a2 2 0 012-2h4a2 2 0 012 2v2">
                                        </path>
                                    </svg>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <!-- Content Preview -->
                            <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-2">{{ $item->isi }}</p>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    {{ $item->tanggapan->count() }} Tanggapan
                                </div>
                                <div class="flex items-center space-x-3">
                                    <form action="{{ route('admin.pengaduan.update-status', $item->id) }}" method="POST"
                                        class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status"
                                            class="text-xs border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="terkirim" {{ $item->status === 'terkirim' ? 'selected' : '' }}>
                                                Terkirim</option>
                                            <option value="diproses" {{ $item->status === 'diproses' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="selesai" {{ $item->status === 'selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                            <option value="ditolak" {{ $item->status === 'ditolak' ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                        <button type="submit"
                                            class="ml-2 px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-md hover:bg-yellow-200 transition-colors">
                                            Update
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.pengaduan.show', $item->id) }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                                        Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengaduan</h3>
                            <p class="text-gray-500">Pengaduan yang masuk akan muncul di sini</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($pengaduan->hasPages())
                <div class="mt-8">
                    {{ $pengaduan->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
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

                const params = new URLSearchParams();
                if (status) params.append('status', status);
                if (kategori) params.append('kategori', kategori);

                const queryString = params.toString();
                const newUrl = queryString ? `/admin/pengaduan?${queryString}` : '/admin/pengaduan';

                window.location.href = newUrl;
            }

            // Simple fade-in animation for cards
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.grid > div');
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        </script>
    @endpush
@endsection
