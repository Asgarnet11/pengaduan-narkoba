@props(['isAdmin'])

<nav x-data="{ open: false }"
    class="sticky top-0 z-50 bg-white shadow-md backdrop-blur supports-backdrop-blur:bg-white/95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Primary Nav -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <i
                            class="fas fa-building text-2xl text-indigo-600 group-hover:scale-110 transition-transform duration-300"></i>
                        <span class="text-xl font-bold text-gradient">Pengaduan</span>
                    </a>
                </div>

                <!-- Primary Navigation -->
                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ url('/') }}" @class([
                            'inline-flex items-center px-1 pt-1 text-sm font-medium transition-all duration-300',
                            'text-gray-900 border-b-2 border-indigo-500' => request()->is('/'),
                            'text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300' => !request()->is(
                                '/'),
                        ])>
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>

                        <a href="{{ route('dashboard') }}" @class([
                            'inline-flex items-center px-1 pt-1 text-sm font-medium transition-all duration-300',
                            'text-gray-900 border-b-2 border-indigo-500' => request()->routeIs(
                                'dashboard'),
                            'text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300' => !request()->routeIs(
                                'dashboard'),
                        ])>
                            <i class="fas fa-table-columns mr-2"></i>
                            Dashboard
                        </a>

                        <a href="{{ route('pengaduan.index') }}" @class([
                            'inline-flex items-center px-1 pt-1 text-sm font-medium transition-all duration-300',
                            'text-gray-900 border-b-2 border-indigo-500' => request()->routeIs(
                                'pengaduan.*'),
                            'text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300' => !request()->routeIs(
                                'pengaduan.*'),
                        ])>
                            <i class="fas fa-file-alt mr-2"></i>
                            Pengaduan
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Search and User Menu -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                @auth
                    <!-- Search Bar -->
                    <div class="relative" x-data="{ isOpen: false, query: '' }" @click.away="isOpen = false">
                        <div class="relative">
                            <input type="text" x-model="query" @focus="isOpen = true"
                                @input.debounce.300ms="if(query.length >= 3) $dispatch('search-query', { query: query })"
                                placeholder="Cari pengaduan..."
                                class="w-64 pl-10 pr-4 py-2 text-sm text-gray-700 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Search Results -->
                        <div x-show="isOpen && query.length >= 3" x-cloak
                            class="absolute mt-2 w-96 bg-white rounded-lg shadow-lg py-2 z-50 max-h-96 overflow-y-auto"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Hasil Pencarian</p>
                            </div>
                            <div id="searchResults" class="max-h-[400px] overflow-y-auto">
                                <!-- Search results will be injected here -->
                            </div>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open"
                                class="flex items-center space-x-3 text-sm focus:outline-none transition duration-300 ease-in-out hover:opacity-80">
                                <img class="h-8 w-8 rounded-full object-cover border-2 border-indigo-500"
                                    src="{{ auth()->user()->getProfilePhotoUrl() }}"
                                    alt="{{ auth()->user()->name }}'s Avatar">
                                <div class="hidden md:block text-left">
                                    <span class="block text-gray-900">{{ auth()->user()->name }}</span>
                                    <span class="block text-xs text-gray-500">{{ auth()->user()->email }}</span>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>
                        </div>

                        <!-- User Dropdown -->
                        <div x-show="open" x-cloak @click.away="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                    class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 transition-all duration-300">
                                    <i class="fas fa-user mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 transition-all duration-300">
                                        <i class="fas fa-sign-out-alt mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('pengaduan.index')" :active="request()->routeIs('pengaduan.*')">
                    <i class="fas fa-file-alt mr-2"></i>
                    Pengaduan
                </x-responsive-nav-link>

                @if ($isAdmin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Admin Panel
                    </x-responsive-nav-link>
                @endif
            </div>

            <!-- Mobile user menu -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->getProfilePhotoUrl() }}"
                            alt="{{ auth()->user()->name }}'s Avatar">
                    </div>
                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user mr-2"></i>
                        Profile
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Keluar
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>

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
                        <img src="https://illustrations.popsy.co/gray/falling-box.svg" alt="No Results" class="w-24 h-24 mb-4">
                        <p class="text-sm text-gray-500">Tidak ada hasil yang ditemukan</p>
                    </div>
                `;
                        return;
                    }

                    searchResults.innerHTML = results.map(result => `
                <a href="${result.url}" class="block px-4 py-3 hover:bg-gray-50 transition duration-200">
                    <div class="flex items-start space-x-3">
                        <img class="h-8 w-8 rounded-full object-cover flex-shrink-0" src="${result.photo_url}" alt="${result.pelapor}'s Avatar">
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div class="truncate">
                                    <p class="text-sm font-medium text-gray-900">${result.judul}</p>
                                    <p class="text-xs text-gray-600 truncate">${result.isi}</p>
                                </div>
                                <span class="ml-2 px-2 py-1 text-xs rounded-full whitespace-nowrap ${getStatusClass(result.status)}">
                                    ${ucfirst(result.status)}
                                </span>
                            </div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <span class="flex items-center">
                                    <i class="far fa-user mr-1"></i>
                                    ${result.pelapor}
                                    ${result.is_own ? '<span class="ml-1 px-1.5 py-0.5 text-xs bg-indigo-100 text-indigo-800 rounded-full">Anda</span>' : ''}
                                </span>
                                <span class="mx-2">•</span>
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
    </script>
@endpush
