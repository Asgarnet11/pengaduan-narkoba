@props(['isAdmin'])

<!-- Mobile backdrop -->
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    <!-- Mobile backdrop overlay -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
        :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-indigo-600 to-purple-600">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                <i
                    class="fas fa-building text-2xl text-white group-hover:scale-110 transition-transform duration-300"></i>
                <span class="text-xl font-bold text-white">Pengaduan</span>
            </a>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false"
                class="lg:hidden text-white hover:text-gray-200 transition-colors duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- User Profile Section -->
        @auth
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-500"
                        src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="{{ auth()->user()->name }}'s Avatar">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Search Section -->
        @auth
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="relative" x-data="{ isOpen: false, query: '' }" @click.away="isOpen = false">
                    <div class="relative">
                        <input type="text" x-model="query" @focus="isOpen = true"
                            @input.debounce.300ms="if(query.length >= 3) $dispatch('search-query', { query: query })"
                            placeholder="Cari pengaduan..."
                            class="w-full pl-10 pr-4 py-2 text-sm text-gray-700 bg-white rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Search Results -->
                    <div x-show="isOpen && query.length >= 3" x-cloak
                        class="absolute mt-2 w-full bg-white rounded-lg shadow-lg py-2 z-50 max-h-80 overflow-y-auto border border-gray-200"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm text-gray-500">Hasil Pencarian</p>
                        </div>
                        <div id="searchResults" class="max-h-64 overflow-y-auto">
                            <!-- Search results will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Navigation Menu -->
        <nav class="flex-1 px-6 py-4 space-y-2 overflow-y-auto">
            @auth
                <a href="{{ route('admin.pengaduan.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('pengaduan.*') ? 'bg-indigo-50 text-indigo-700 border-r-4 border-indigo-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i
                        class="fas fa-file-alt w-5 text-center mr-3 {{ request()->routeIs('pengaduan.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                    Pengaduan
                </a>
                @if ($isAdmin)
                    <a href="{{ route('admin.user.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('pengaduan.*') ? 'bg-indigo-50 text-indigo-700 border-r-4 border-indigo-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i
                            class="fas fa-file-alt w-5 text-center mr-3 {{ request()->routeIs('pengaduan.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Kelola Akun
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-indigo-50 text-indigo-700 border-r-4 border-indigo-500' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i
                            class="fas fa-shield-alt w-5 text-center mr-3 {{ request()->routeIs('admin.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Admin Panel
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                    <i class="fas fa-sign-in-alt w-5 text-center mr-3 text-gray-400"></i>
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-all duration-200">
                    <i class="fas fa-user-plus w-5 text-center mr-3"></i>
                    Register
                </a>
            @endauth
        </nav>

        <!-- User Menu (Bottom Section) -->
        @auth
            <div class="border-t border-gray-200 p-6">
                <div class="space-y-2">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                        <i class="fas fa-user w-5 text-center mr-3 text-gray-400"></i>
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                            <i class="fas fa-sign-out-alt w-5 text-center mr-3 text-gray-400"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <!-- Main content area -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
        <!-- Mobile header -->
        <div class="lg:hidden bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 py-3 flex items-center justify-between">
                <button @click="sidebarOpen = true"
                    class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="flex items-center space-x-3">
                    <i class="fas fa-building text-xl text-indigo-600"></i>
                    <span class="text-lg font-bold text-gray-900">Pengaduan</span>
                </div>

                @auth
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full object-cover border-2 border-indigo-500"
                            src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="{{ auth()->user()->name }}'s Avatar">
                    </div>
                @else
                    <div class="w-8"></div>
                @endauth
            </div>
        </div>

        <!-- Content wrapper -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Your main content goes here -->
                @yield('content')
            </div>
        </main>
    </div>
</div>

@push('scripts')
    <script>
        // Search functionality
        window.addEventListener('search-query', event => {
            const query = event.detail.query;
            fetch(`/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(results => {
                    const searchResults = document.getElementById('searchResults');
                    if (results.length === 0) {
                        searchResults.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-8">
                        <img src="https://illustrations.popsy.co/gray/falling-box.svg" alt="No Results" class="w-16 h-16 mb-4">
                        <p class="text-sm text-gray-500">Tidak ada hasil yang ditemukan</p>
                    </div>
                `;
                        return;
                    }

                    searchResults.innerHTML = results.map(result => `
                <a href="${result.url}" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">
                    <div class="flex items-start space-x-3">
                        <img class="h-6 w-6 rounded-full object-cover flex-shrink-0" src="${result.photo_url}" alt="${result.pelapor}'s Avatar">
                        <div class="flex-1 min-w-0">
                            <div class="truncate">
                                <p class="text-sm font-medium text-gray-900 truncate">${result.judul}</p>
                                <p class="text-xs text-gray-600 truncate">${result.isi}</p>
                            </div>
                            <div class="mt-1 flex items-center justify-between">
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="flex items-center">
                                        <i class="far fa-user mr-1"></i>
                                        ${result.pelapor}
                                        ${result.is_own ? '<span class="ml-1 px-1 py-0.5 text-xs bg-indigo-100 text-indigo-800 rounded">Anda</span>' : ''}
                                    </span>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full ${getStatusClass(result.status)}">
                                    ${ucfirst(result.status)}
                                </span>
                            </div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <span class="flex items-center">
                                    <i class="far fa-folder mr-1"></i>
                                    ${result.kategori}
                                </span>
                                <span class="mx-2">•</span>
                                <span>${result.created_at}</span>
                            </div>
                        </div>
                    </div>
                </a>
            `).join('<div class="border-t border-gray-100"></div>');
                });
        });

        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function getStatusClass(status) {
            switch (status) {
                case 'selesai':
                    return 'bg-green-100 text-green-800';
                case 'diproses':
                    return 'bg-yellow-100 text-yellow-800';
                case 'ditolak':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        // Auto-close sidebar on mobile when clicking nav links
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav a');
            const sidebarToggle = document.querySelector('[x-data]');

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) {
                        // Close sidebar on mobile
                        Alpine.store('sidebarOpen', false);
                    }
                });
            });
        });
    </script>
@endpush
