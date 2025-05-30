@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700">{{ $pengaduan->judul }}</h2>
        <div class="mb-2 text-sm text-gray-500 flex items-center gap-2">
            <span>Dibuat pada: {{ $pengaduan->created_at->format('d M Y H:i') }}</span>
            <span class="mx-2">|</span>
            <span>Status:
                @if($pengaduan->status === 'selesai')
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Selesai</span>
                @elseif($pengaduan->status === 'proses')
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Proses</span>
                @elseif($pengaduan->status === 'ditolak')
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Ditolak</span>
                @else
                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">{{ ucfirst($pengaduan->status) }}</span>
                @endif
            </span>
        </div>
        <div class="mb-2 text-sm text-gray-500">
            Kategori: <span class="font-semibold text-gray-700">{{ $pengaduan->kategori->nama ?? '-' }}</span>
        </div>
        <div class="mb-2 text-sm text-gray-500">
            Pelapor: <span class="font-semibold text-gray-700">{{ $pengaduan->user->name ?? '-' }}</span>
        </div>
        <div class="my-6">
            <h3 class="font-semibold mb-2">Isi Pengaduan:</h3>
            <div class="bg-gray-50 p-4 rounded text-gray-800">{{ $pengaduan->isi }}</div>
        </div>
        @if($pengaduan->foto)
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Lampiran Foto:</h3>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="rounded shadow max-w-xs">
            </div>
        @endif
        <!-- Form Tanggapan (jika ingin user bisa balas, atau bisa dihapus jika hanya admin) -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Berikan Tanggapan</h3>
            <form action="{{ route('pengaduan.tanggapan', $pengaduan->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea name="isi_tanggapan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Tulis tanggapan Anda di sini..."></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
        @if($pengaduan->tanggapan->count() > 0)
            <div class="mt-8">
                <h3 class="font-semibold text-indigo-700 mb-4">Tanggapan Admin</h3>
                @foreach($pengaduan->tanggapan as $tanggapan)
                    <div class="p-4 bg-indigo-50 rounded mb-4">
                        <div class="text-gray-800 mb-1">{{ $tanggapan->isi_tanggapan }}</div>
                        <div class="text-xs text-gray-500">Oleh: {{ $tanggapan->admin->name ?? 'Admin' }} pada {{ $tanggapan->created_at->format('d M Y H:i') }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="mt-6">
        <a href="{{ route('pengaduan.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Kembali ke Daftar Pengaduan</a>
    </div>
</div>
@endsection
