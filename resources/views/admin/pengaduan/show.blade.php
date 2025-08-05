@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="max-w-4xl mx-auto py-4 px-4 sm:py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
                <h2 class="text-xl sm:text-2xl font-bold text-indigo-700">{{ $pengaduan->judul }}</h2>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('admin.pengaduan.update-status', $pengaduan->id) }}" method="POST"
                        class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0">
                        @csrf
                        @method('PUT')
                        <select name="status"
                            class="w-full sm:w-auto rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                            class="w-full sm:w-auto sm:ml-2 px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 transition-colors">Update
                            Status</button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500"> Identitas Pelapor</p>
                    <p class="font-medium">{{ $pengaduan->user->name }}</p>
                    <div class="mt-1 font-bold col-auto">
                        <p class="text-sm text-gray-500"> Email Pelapor</p>
                        <p class="font-medium">{{ $pengaduan->user->email }}</p>
                    </div>
                    <div class="mt-1 font-bold col-auto">
                        <p class="text-sm text-gray-500"> NIK Pelapor</p>
                        <p class="font-medium">{{ $pengaduan->user->nik }}</p>
                    </div>
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
                        class="rounded shadow max-w-full h-auto">
                </div>
            @endif

            @if ($pengaduan->latitude && $pengaduan->longitude)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Lokasi Kejadian
                    </h3>

                    <!-- Map Container dengan border dan shadow yang lebih menarik -->
                    <div class="relative">
                        <div id="map-admin"
                            class="w-full h-64 sm:h-80 lg:h-96 rounded-xl shadow-lg border-2 border-gray-200 overflow-hidden">
                        </div>

                        <!-- Loading overlay -->
                        <div id="map-loading"
                            class="absolute inset-0 bg-gray-100 rounded-xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto mb-2">
                                </div>
                                <p class="text-sm text-gray-600">Memuat peta...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons dengan layout responsif -->
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                            target="_blank"
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white font-medium text-sm rounded-lg hover:bg-red-700 transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            Buka di Google Maps
                        </a>

                        <button onclick="centerMap()"
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-medium text-sm rounded-lg hover:bg-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pusatkan Peta
                        </button>

                        <button onclick="toggleFullscreen()"
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 text-white font-medium text-sm rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                            </svg>
                            Layar Penuh
                        </button>
                    </div>

                    <!-- Koordinat info -->
                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Koordinat:</span>
                            {{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Form Tanggapan -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Berikan Tanggapan</h3>
                <form action="{{ route('admin.pengaduan.tanggapan', $pengaduan->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="isi_tanggapan" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                            placeholder="Tulis tanggapan Anda di sini..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors">Kirim
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
                class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">Kembali
                ke
                Dashboard</a>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        let mapAdmin;
        let marker;
        let isFullscreen = false;

        document.addEventListener('DOMContentLoaded', function() {
            @if ($pengaduan->latitude && $pengaduan->longitude)
                var lat = {{ $pengaduan->latitude }};
                var lon = {{ $pengaduan->longitude }};

                // Hide loading overlay after a short delay
                setTimeout(() => {
                    document.getElementById('map-loading').style.display = 'none';
                }, 500);

                // Initialize map with better options
                mapAdmin = L.map('map-admin', {
                    center: [lat, lon],
                    zoom: 16,
                    zoomControl: true,
                    scrollWheelZoom: true,
                    doubleClickZoom: true,
                    boxZoom: true,
                    keyboard: true,
                    dragging: true,
                    touchZoom: true,
                    tap: true,
                    maxZoom: 19,
                    minZoom: 5
                });

                // Add multiple tile layer options
                var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                });

                var satelliteLayer = L.tileLayer(
                    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                        attribution: '© Esri',
                        maxZoom: 19
                    });

                var topoLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenTopoMap contributors',
                    maxZoom: 17
                });

                // Add default layer
                osmLayer.addTo(mapAdmin);

                // Layer control
                var baseMaps = {
                    "Peta Standar": osmLayer,
                    "Satelit": satelliteLayer,
                    "Topografi": topoLayer
                };

                L.control.layers(baseMaps).addTo(mapAdmin);

                // Custom marker icon
                var customIcon = L.divIcon({
                    html: '<div style="background-color: #ef4444; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="white" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><circle cx="8" cy="6" r="2" fill="#ef4444"/></svg></div>',
                    className: '',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12]
                });

                // Add marker with popup
                var googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${lat},${lon}`;
                var popupContent = `
                    <div style="text-align: center; padding: 5px;">
                        <b style="color: #1f2937;">📍 Lokasi Laporan</b><br>
                        <small style="color: #6b7280;">${lat.toFixed(6)}, ${lon.toFixed(6)}</small><br>
                        <a href="${googleMapsUrl}" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 500; margin-top: 8px; display: inline-block;">
                            🗺️ Buka di Google Maps
                        </a>
                    </div>
                `;

                marker = L.marker([lat, lon], {
                        icon: customIcon
                    })
                    .addTo(mapAdmin)
                    .bindPopup(popupContent)
                    .openPopup();

                // Add scale control
                L.control.scale({
                    position: 'bottomleft'
                }).addTo(mapAdmin);

                // Handle map resize for mobile
                window.addEventListener('resize', function() {
                    setTimeout(function() {
                        mapAdmin.invalidateSize();
                    }, 100);
                });

                // Add click event to show coordinates
                mapAdmin.on('click', function(e) {
                    console.log('Clicked at: ' + e.latlng.lat + ', ' + e.latlng.lng);
                });
            @endif
        });

        // Center map function
        function centerMap() {
            @if ($pengaduan->latitude && $pengaduan->longitude)
                var lat = {{ $pengaduan->latitude }};
                var lon = {{ $pengaduan->longitude }};
                mapAdmin.setView([lat, lon], 16);
                marker.openPopup();
            @endif
        }

        // Toggle fullscreen
        function toggleFullscreen() {
            const mapContainer = document.getElementById('map-admin');

            if (!isFullscreen) {
                mapContainer.style.position = 'fixed';
                mapContainer.style.top = '0';
                mapContainer.style.left = '0';
                mapContainer.style.width = '100vw';
                mapContainer.style.height = '100vh';
                mapContainer.style.zIndex = '9999';
                mapContainer.style.borderRadius = '0';
                isFullscreen = true;

                // Add close button
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '✕';
                closeBtn.id = 'close-fullscreen';
                closeBtn.style.cssText =
                    'position: absolute; top: 10px; right: 10px; z-index: 10000; background: rgba(0,0,0,0.7); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 18px;';
                closeBtn.onclick = toggleFullscreen;
                mapContainer.appendChild(closeBtn);
            } else {
                mapContainer.style.position = 'relative';
                mapContainer.style.top = 'auto';
                mapContainer.style.left = 'auto';
                mapContainer.style.width = '100%';
                mapContainer.style.height = window.innerWidth < 640 ? '16rem' : window.innerWidth < 1024 ? '20rem' :
                    '24rem';
                mapContainer.style.zIndex = 'auto';
                mapContainer.style.borderRadius = '0.75rem';
                isFullscreen = false;

                // Remove close button
                const closeBtn = document.getElementById('close-fullscreen');
                if (closeBtn) closeBtn.remove();
            }

            setTimeout(() => {
                mapAdmin.invalidateSize();
            }, 100);
        }
    </script>
@endpush
