<x-app-layout>
    {{-- Hapus x-slot name="header" karena kita akan membuat navbar custom --}}

    {{-- ============================== --}}
    {{-- A. CUSTOM NAVBAR (UPDATED)     --}}
    {{-- ============================== --}}
    <nav class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                    Logo {{-- Ganti dengan gambar logo Anda --}}
                </a>
            </div>

            {{-- Grup Search dan Kategori (di tengah) --}}
            <div class="flex-grow max-w-xl mx-8">
                <div class="flex w-full">
                    {{-- Dropdown Kategori --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex-shrink-0 z-50 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">
                            Category
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            @foreach ($categories as $category)
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    {{-- Search Input --}}
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Product..." required />
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


            {{-- Icons: Cart & User Dropdown --}}
            <div class="flex items-center space-x-6">
                {{-- Ikon Keranjang --}}
                <a href="#" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </a>

                {{-- Dropdown untuk User/Guest --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                        @auth
                            {{-- Konten untuk user yang sudah login --}}
                            <div class="px-4 py-2 text-sm text-gray-700">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </a>
                            </form>
                        @else
                            {{-- Konten untuk tamu (belum login) --}}
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- ============================== --}}
    {{-- B. HERO SECTION                --}}
    {{-- ============================== --}}
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 text-white text-center md:text-left mb-10 md:mb-0 relative z-10">
                <h1 class="text-5xl font-extrabold leading-tight">
                    Shopping And <br> Department Store.
                </h1>
                <p class="mt-4 text-lg max-w-md">
                    Shopping is a bit of a relaxing hobby for me, which is sometimes troubling for the bank balance.
                </p>
                <a href="#" class="mt-8 inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                    Learn More
                </a>
            </div>
            <div class="md:w-1/2 relative z-10">
                {{-- Ini adalah bagian untuk gambar ilustrasi. Anda bisa menggantinya dengan gambar asli. --}}
                {{-- Untuk sementara, kita pakai placeholder atau ilustrasi CSS --}}
                <div class="relative w-full h-80 flex items-center justify-center">
                    <img src="https://via.placeholder.com/600x400/fff/000?text=Hero+Image+Placeholder" alt="Hero Illustration" class="max-w-full h-auto rounded-lg shadow-2xl">
                    {{-- Alternatif jika punya gambar asli yang transparan dan mau seperti desain: --}}
                    {{-- <img src="{{ asset('storage/image/hero-illustration.png') }}" alt="Shopping Illustration" class="absolute inset-0 w-full h-full object-contain"> --}}
                </div>
            </div>
        </div>
        {{-- Bentuk-bentuk abstrak di background (opsional, bisa diganti dengan gambar) --}}
        <div class="absolute bottom-0 right-0 transform translate-x-1/4 translate-y-1/4 w-96 h-96 bg-blue-400 opacity-20 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 left-0 transform -translate-x-1/4 -translate-y-1/4 w-72 h-72 bg-purple-400 opacity-20 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
    </section>

    {{-- ============================== --}}
    {{-- C. FEATURED PRODUCTS (Grid)    --}}
    {{-- ============================== --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Our Product</h2>
                        
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden">
                        {{-- Area Gambar & Tombol Wishlist --}}
                        <div class="aspect-w-1 aspect-h-1 bg-gray-50 group-hover:opacity-75">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                        </div>

                        {{-- Tombol Wishlist (Hati) --}}
                        <button class="absolute top-3 right-3 bg-white/70 backdrop-blur-sm p-2 rounded-full text-gray-400 hover:text-red-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                        </button>

                        {{-- Area Info Produk --}}
                        <div class="p-4">
                            {{-- Baris Nama & Harga --}}
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-md font-semibold text-gray-800">
                                        <a href="#">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                                </div>
                                <p class="text-md font-medium text-gray-900">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Rating Bintang --}}
                            <div class="flex items-center mt-3">
                                <div class="flex items-center">
                                    {{-- SVG untuk 5 bintang --}}
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <p class="ml-2 text-sm text-gray-500">(121)</p>
                            </div>

                            {{-- Tombol Add to Cart --}}
                            <button class="mt-4 w-full bg-white border border-gray-300 text-gray-700 font-semibold py-2 rounded-md hover:bg-gray-50 transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        <p>Maaf, belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Link Pagination --}}
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </section>

</x-app-layout>