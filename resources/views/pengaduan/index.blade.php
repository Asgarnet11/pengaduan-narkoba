@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="max-w-7xl mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-indigo-700">Daftar Pengaduan</h2>
            <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>
                Buat Pengaduan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pengaduan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ $item->user->getProfilePhotoUrl() }}"
                                         alt="{{ $item->user->name }}">
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->user->name }}
                                            @if($item->user_id === Auth::id())
                                                <span class="ml-1 px-2 py-0.5 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $item->kategori->nama }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span @class([
                                    'px-2 py-1 text-xs font-medium rounded-full',
                                    'bg-gray-100 text-gray-800' => $item->status === 'terkirim',
                                    'bg-yellow-100 text-yellow-800' => $item->status === 'diproses',
                                    'bg-green-100 text-green-800' => $item->status === 'selesai',
                                    'bg-red-100 text-red-800' => $item->status === 'ditolak',
                                ])>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('pengaduan.show', $item->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <img src="https://illustrations.popsy.co/gray/falling-box.svg" alt="No Data" class="w-32 h-32 mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengaduan</h3>
                                    <p class="text-gray-500 mb-4">Belum ada pengaduan yang dibuat.</p>
                                    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-duration-300">
                                        <i class="fas fa-plus mr-2"></i>
                                        Buat Pengaduan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
