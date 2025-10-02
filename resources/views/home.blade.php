<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    {{-- B. HERO SECTION                --}}
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
                    <img src="{{ asset('storage/images/hero-illustration.png') }}" alt="Hero Illustration" class="max-w-full h-auto">
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
            
            @if (request('category'))
                @php
                    $activeCategory = $categories->firstWhere('slug', request('category'));
                @endphp
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">
                        Kategori: <span class="text-blue-600">{{ $activeCategory->name ?? '' }}</span>
                    </h2>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-red-500 hover:underline">
                        Hapus Filter &times;
                    </a>
                </div>
            @else
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Our Product</h2>
            @endif
                        
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden">
                        {{-- Area Gambar & Tombol Wishlist --}}
                        <div class="aspect-w-1 aspect-h-1 bg-gray-50 group-hover:opacity-75">
                            {{-- Link pada gambar sudah tidak diperlukan di sini --}}
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                        </div>

                        {{-- Tombol Wishlist (Hati) --}}
                        <button class="absolute top-3 right-3 bg-white/70 backdrop-blur-sm p-2 rounded-full text-gray-400 hover:text-red-500 transition z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                        </button>

                        {{-- Area Info Produk --}}
                        <div class="p-4">
                            {{-- Baris Nama & Harga --}}
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-md font-semibold text-gray-800">
                                        {{-- PERUBAHAN UTAMA: Perbaiki href di sini --}}
                                        <a href="{{ route('products.show', $product->slug) }}">
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