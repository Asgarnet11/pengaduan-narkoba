<!-- Footer -->
<footer class="bg-gradient-to-b from-gray-900 to-black text-white relative overflow-hidden"
    aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>

    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 100 100">
            <defs>
                <pattern id="police-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="%23ffffff" />
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(%23police-pattern)" /></svg>'); background-size: 40px 40px;">
        </div>
    </div>

    <!-- Police Stripe Top -->
    <div class="h-2 bg-gradient-to-r from-yellow-400 via-yellow-300 to-yellow-400"></div>

    <div class="relative z-10 max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Logo and Description Section -->
            <div class="space-y-6">
                <!-- Police Logos -->
                <div class="flex items-center space-x-4 mb-6">
                    <div class="relative group">
                        <img src="{{ asset('assets/logo-polres.png') }}" alt="Logo Polres Konawe Selatan"
                            class="h-16 w-16 object-contain transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-yellow-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="{{ asset('assets/logo-konsel.png') }}" alt="Logo Konawe Selatan"
                            class="h-16 w-16 object-contain transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-yellow-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                        </div>
                    </div>
                </div>

                <!-- Title with Police Theme -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-shield-alt text-blue-900 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-yellow-300 font-display">POLRES KONAWE SELATAN</h3>
                            <p class="text-blue-300 text-sm font-medium">Sistem Pengaduan Narkoba</p>
                        </div>
                    </div>
                </div>

                <p class="text-gray-300 leading-relaxed text-sm max-w-md">
                    Platform pelaporan yang aman, rahasia, dan terpercaya untuk mendukung upaya pemberantasan narkoba di
                    Kabupaten Konawe Selatan.
                    <span class="text-yellow-400 font-semibold">Melayani dengan Integritas.</span>
                </p>

                <!-- Police Motto -->
                <div class="bg-blue-900/30 border-l-4 border-yellow-400 p-4 rounded-r-lg backdrop-blur-sm">
                    <p class="text-yellow-300 font-semibold text-sm italic">
                        "Rastra Sewakottama" - Abdi Utama Bagi Negara
                    </p>
                </div>

                <!-- Social Media -->
                <div class="space-y-3">
                    <h5 class="text-gray-300 font-semibold text-sm uppercase tracking-wider">Ikuti Kami</h5>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-blue-800/50 hover:bg-blue-700 rounded-full transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook text-white text-lg group-hover:text-yellow-300"></i>
                        </a>
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-blue-800/50 hover:bg-blue-700 rounded-full transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram text-white text-lg group-hover:text-yellow-300"></i>
                        </a>
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-blue-800/50 hover:bg-blue-700 rounded-full transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter text-white text-lg group-hover:text-yellow-300"></i>
                        </a>
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-blue-800/50 hover:bg-blue-700 rounded-full transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-youtube text-white text-lg group-hover:text-yellow-300"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation and Contact Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:col-span-1">
                <!-- Navigation Menu -->
                <div class="space-y-4">
                    <h4
                        class="text-lg font-semibold text-yellow-300 uppercase tracking-wider flex items-center space-x-2">
                        <i class="fas fa-bars w-4"></i>
                        <span>Menu Utama</span>
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="/"
                                class="group flex items-center space-x-2 text-sm text-gray-300 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-home w-4 text-blue-400 group-hover:text-yellow-400"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-300">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengaduan.create') }}"
                                class="group flex items-center space-x-2 text-sm text-gray-300 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-exclamation-triangle w-4 text-red-400 group-hover:text-yellow-400"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-300">Buat
                                    Laporan</span>
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="group flex items-center space-x-2 text-sm text-gray-300 hover:text-yellow-300 transition-all duration-300">
                                    <i class="fas fa-tachometer-alt w-4 text-green-400 group-hover:text-yellow-400"></i>
                                    <span class="group-hover:translate-x-1 transition-transform duration-300">Dashboard
                                        Saya</span>
                                </a>
                            </li>
                            @if (auth()->user()->isAdmin())
                                <li>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="group flex items-center space-x-2 text-sm text-yellow-400 hover:text-yellow-300 transition-all duration-300 font-medium">
                                        <i class="fas fa-shield-alt w-4 text-yellow-400 group-hover:text-yellow-300"></i>
                                        <span class="group-hover:translate-x-1 transition-transform duration-300">Panel
                                            Petugas</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <h4
                        class="text-lg font-semibold text-yellow-300 uppercase tracking-wider flex items-center space-x-2">
                        <i class="fas fa-phone w-4"></i>
                        <span>Kontak</span>
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-blue-800/50 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-map-marker-alt text-red-400 text-sm"></i>
                            </div>
                            <div class="text-sm text-gray-300">
                                <p class="font-medium text-white mb-1">Alamat Kantor:</p>
                                <p class="leading-relaxed">Jl. Poros Kendari - Andoolo Km.61<br>Kabupaten Konawe
                                    Selatan<br>Sulawesi Tenggara</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-blue-800/50 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-phone text-green-400 text-sm"></i>
                            </div>
                            <div class="text-sm text-gray-300">
                                <p class="font-medium text-white mb-1">Telepon:</p>
                                <a href="tel:+621234567890"
                                    class="hover:text-yellow-300 transition-colors duration-300">
                                    +62 123 4567 890
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3 group">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-blue-800/50 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-clock text-blue-400 text-sm"></i>
                            </div>
                            <div class="text-sm text-gray-300">
                                <p class="font-medium text-white mb-1">Jam Layanan:</p>
                                <p>24/7 - Siaga Melayani</p>
                            </div>
                        </li>
                    </ul>

                    <!-- Emergency Hotline -->
                    <div class="bg-red-900/30 border border-red-500/30 rounded-lg p-4 mt-6">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-exclamation-triangle text-red-400 animate-pulse"></i>
                            <span class="text-red-300 font-semibold text-sm uppercase">Hotline Darurat</span>
                        </div>
                        <a href="tel:110"
                            class="text-red-400 font-bold text-lg hover:text-red-300 transition-colors duration-300">
                            110 - Polisi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-yellow-300 uppercase tracking-wider flex items-center space-x-2">
                    <i class="fas fa-map-marked-alt w-4"></i>
                    <span>Lokasi Polres Konawe Selatan</span>
                </h4>
                <div class="bg-gray-800/50 rounded-lg p-2 border border-gray-700">
                    <div id="footer-map" class="h-48 w-full rounded-lg border border-gray-600 bg-gray-800"></div>
                </div>

                <!-- Map Info -->
                <div class="bg-blue-900/20 rounded-lg p-4 border-l-4 border-yellow-400">
                    <p class="text-sm text-gray-300 mb-2">
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Klik peta untuk membuka di aplikasi maps
                    </p>
                    <a href="https://maps.google.com/?q=-4.1325,122.4567" target="_blank"
                        class="inline-flex items-center space-x-2 text-sm text-yellow-400 hover:text-yellow-300 transition-colors duration-300">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Buka di Google Maps</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-16 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Copyright -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-shield-alt text-yellow-400"></i>
                        <span class="text-sm text-gray-400">
                            &copy; {{ date('Y') }} Polres Konawe Selatan. All Rights Reserved.
                        </span>
                    </div>
                </div>

                <!-- Government Links -->
                <div class="flex items-center space-x-6 text-sm text-gray-400">
                    <a href="#"
                        class="hover:text-yellow-300 transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-balance-scale text-xs"></i>
                        <span>Kebijakan Privasi</span>
                    </a>
                    <a href="#"
                        class="hover:text-yellow-300 transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-file-contract text-xs"></i>
                        <span>Syarat & Ketentuan</span>
                    </a>
                    <a href="https://www.polri.go.id" target="_blank"
                        class="hover:text-yellow-300 transition-colors duration-300 flex items-center space-x-1">
                        <i class="fas fa-external-link-alt text-xs"></i>
                        <span>POLRI.GO.ID</span>
                    </a>
                </div>
            </div>

            <!-- Police Badge Bottom -->
            <div class="flex justify-center mt-8">
                <div class="flex items-center space-x-2 text-xs text-gray-500">
                    <i class="fas fa-badge text-yellow-600"></i>
                    <span>Kepolisian Negara Republik Indonesia</span>
                    <i class="fas fa-badge text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Police Stripe Bottom -->
    <div class="h-1 bg-gradient-to-r from-blue-900 via-yellow-400 to-blue-900"></div>
</footer>
