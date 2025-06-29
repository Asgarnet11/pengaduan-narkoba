@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-indigo-700">{{ $pengaduan->judul }}</h2>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('admin.pengaduan.update-status', $pengaduan->id) }}" method="POST"
                        class="flex items-center">
                        @csrf
                        @method('PUT')
                        <select name="status"
                            class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="terkirim" {{ $pengaduan->status === 'terkirim' ? 'selected' : '' }}>Terkirim
                            </option>
                            <option value="diproses" {{ $pengaduan->status === 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="ditolak" {{ $pengaduan->status === 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                        <button type="submit"
                            class="ml-2 px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">Update
                            Status</button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-medium">{{ $pengaduan->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-medium">{{ $pengaduan->kategori->nama ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Pengaduan</p>
                    <p class="font-medium">{{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-medium">
                        @if ($pengaduan->status === 'selesai')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Selesai</span>
                        @elseif($pengaduan->status === 'diproses')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Diproses</span>
                        @elseif($pengaduan->status === 'ditolak')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Ditolak</span>
                        @else
                            <span
                                class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">{{ ucfirst($pengaduan->status) }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Isi Pengaduan</h3>
                <div class="bg-gray-50 p-4 rounded text-gray-800">{{ $pengaduan->isi }}</div>
            </div>

            @if ($pengaduan->foto)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Lampiran Foto</h3>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan"
                        class="rounded shadow max-w-xs">
                </div>
            @endif

            <!-- Form Tanggapan -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Berikan Tanggapan</h3>
                <form action="{{ route('admin.pengaduan.tanggapan', $pengaduan->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="isi_tanggapan" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Tulis tanggapan Anda di sini..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Kirim
                            Tanggapan</button>
                    </div>
                </form>
            </div>

            @if ($pengaduan->tanggapan->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-indigo-700 mb-2">Daftar Tanggapan</h3>
                    @foreach ($pengaduan->tanggapan as $tanggapan)
                        <div class="p-4 bg-indigo-50 rounded mb-4">
                            <div class="text-gray-800 mb-1">{{ $tanggapan->isi_tanggapan }}</div>
                            <div class="text-xs text-gray-500">Oleh: {{ $tanggapan->admin->name ?? 'Admin' }} pada
                                {{ $tanggapan->created_at->format('d M Y H:i') }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Kembali ke
                Dashboard</a>
        </div>
    </div>
@endsection
