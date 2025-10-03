    <nav class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-3xl font-bold text-gray-800">
                    Tuku.co {{-- Ganti dengan gambar logo Anda --}}
                </a>
            </div>

            <div class="flex-grow max-w-xl mx-8">
                <form method="GET" action="{{ route('home') }}" class="flex w-full">
                    {{-- Dropdown Kategori --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">
                            Category
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-20 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            @foreach ($categories as $category)
                                <a href="{{ route('home', ['category' => $category->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    {{-- Search Input --}}
                    <div class="relative w-full">
                        <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Product..." value="{{ request('search') }}" />
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-gray-900 bg-white rounded-e-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>


            {{-- Icons: Cart & User Dropdown --}}
            <div class="flex items-center space-x-4">
                {{-- Ikon Keranjang --}}
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </a>

                {{-- Pemisah Vertikal --}}
                <div class="border-l border-gray-300 h-6"></div>

                @auth
                    {{-- JIKA SUDAH LOGIN: Tampilkan Dropdown Profil --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="hidden sm:inline font-medium">{{ Auth::user()->name }}</span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            {{-- Konten dropdown untuk user yang sudah login --}}
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard Admin</a>
                            @endif
                            <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Home</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</a>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- JIKA BELUM LOGIN: Tampilkan Tombol Masuk & Daftar --}}
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-gray-700 font-bold py-2 px-4 rounded-lg border border-gray-300 hover:bg-white hover:text-blue-600 hover:border-blue-600 transition-colors duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg border-2 border-transparent hover:bg-white hover:text-blue-600 hover:border-blue-600 transition-colors duration-300">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

        </div>
    </nav>