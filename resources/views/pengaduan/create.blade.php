@extends('layouts.app')

@section('title', 'Buat Pengaduan Baru')

{{-- CSS Styles --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/form-peta.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                {{-- Header Section --}}
                <div class="text-center mb-10">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-full mb-6">
                        <i class="fas fa-shield-alt text-3xl"></i>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-3">Formulir Pengaduan Narkoba</h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Laporkan aktivitas mencurigakan di sekitar Anda. Identitas Anda dijamin kerahasiaannya dan akan
                        ditangani dengan serius oleh pihak berwenang.
                    </p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert bg-red-50 border-red-200 text-red-700" role="alert">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold mb-2">Terjadi Kesalahan pada Input Anda:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert bg-green-50 border-green-200 text-green-700" role="alert">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Form Container --}}
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-edit mr-3"></i>
                            Detail Pengaduan
                        </h2>
                    </div>

                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                        class="p-8" id="pengaduanForm">
                        @csrf

                        {{-- Basic Information Section --}}
                        <div class="form-section">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                                Informasi Dasar
                            </h3>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <label for="judul" class="block text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-heading text-gray-500 mr-2"></i>
                                        Judul Pengaduan
                                    </label>
                                    <input type="text" name="judul" id="judul" class="form-input w-full"
                                        value="{{ old('judul') }}" placeholder="Contoh: Penjualan Narkoba di Jalan ABC"
                                        required>
                                </div>

                                <div>
                                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-3">
                                        <i class="fas fa-tags text-gray-500 mr-2"></i>
                                        Kategori Laporan
                                    </label>
                                    <select name="kategori_id" id="kategori_id" class="form-select w-full" required>
                                        <option value="">Pilih Kategori...</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="isi" class="block text-gray-700 font-semibold mb-3">
                                    <i class="fas fa-align-left text-gray-500 mr-2"></i>
                                    Isi Laporan Lengkap
                                </label>
                                <textarea name="isi" id="isi" rows="6" class="form-textarea w-full"
                                    placeholder="Jelaskan secara detail aktivitas yang Anda laporkan. Semakin detail informasi yang diberikan, semakin memudahkan pihak berwenang untuk menindaklanjuti laporan Anda."
                                    required>{{ old('isi') }}</textarea>
                                <div class="text-sm text-gray-500 mt-2">
                                    <span id="charCount">0</span> karakter
                                </div>
                            </div>
                        </div>

                        {{-- Location Section --}}
                        <div class="form-section">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-map-marker-alt text-red-600 mr-3"></i>
                                Lokasi Kejadian (TKP)
                            </h3>

                            <div class="map-controls">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                                    <div class="lg:col-span-2">
                                        <label for="lokasi_pencarian" class="block text-gray-700 font-semibold mb-2">
                                            Cari Lokasi
                                        </label>
                                        <div class="search-group">
                                            <input type="text" id="lokasi_pencarian" class="form-input w-full pr-12"
                                                placeholder="Ketik nama jalan, desa, atau landmark...">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <i class="fas fa-search text-gray-400"></i>
                                            </div>
                                            <div id="searchResults" class="search-results"></div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row lg:flex-col gap-2">
                                        <button class="btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg"
                                            type="button" id="tombol_cari">
                                            <i class="fas fa-search"></i>
                                            <span>Cari</span>
                                        </button>
                                        <button class="btn bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg"
                                            type="button" id="tombol_lokasi_saya" title="Gunakan Lokasi Saya Saat Ini">
                                            <i class="fas fa-crosshairs"></i>
                                            <span>Lokasi Saya</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-3">
                                    Konfirmasi di Peta
                                </label>
                                <div id="map"></div>
                                <div class="coordinates-display">
                                    <strong>Koordinat:</strong>
                                    <span id="coordDisplay">-4.1325, 122.4567</span>
                                    <button type="button" id="copyCoords" class="ml-3 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-copy"></i> Salin
                                    </button>
                                </div>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                                <div class="flex">
                                    <i class="fas fa-info-circle text-blue-500 mr-3 mt-1"></i>
                                    <div class="text-sm text-blue-700">
                                        <p><strong>Petunjuk:</strong></p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Peta dimulai dari lokasi Polres Konawe Selatan</li>
                                            <li>Gunakan pencarian untuk menemukan lokasi dengan cepat</li>
                                            <li>Geser penanda merah untuk menyesuaikan posisi yang tepat</li>
                                            <li>Pastikan koordinat sudah sesuai sebelum mengirim laporan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Hidden Coordinates --}}
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        {{-- Evidence Section --}}
                        <div class="form-section">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-camera text-purple-600 mr-3"></i>
                                Lampiran Bukti
                            </h3>

                            <div>
                                <label for="foto" class="block text-gray-700 font-semibold mb-3">
                                    Upload Foto (Opsional)
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="foto" id="foto" class="file-input"
                                        accept=".jpg,.jpeg,.png,.gif" onchange="previewImage(event)">
                                </div>
                                <div class="text-sm text-gray-500 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Ukuran maksimal: 2MB. Format yang didukung: JPG, PNG, GIF
                                </div>

                                {{-- Image Preview --}}
                                <div id="imagePreview" class="mt-4 hidden">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                                    <img id="preview" src="" alt="Preview"
                                        class="max-w-xs rounded-lg border-2 border-gray-200">
                                    <button type="button" onclick="removeImage()"
                                        class="ml-4 text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Section --}}
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-sm text-gray-600">
                                    <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                    Laporan Anda akan diproses dengan kerahasiaan terjamin
                                </div>
                                <button type="submit" id="submitBtn"
                                    class="btn bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl text-lg">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Kirim Laporan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- JavaScript --}}
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/form-peta.js') }}"></script>
@endpush
