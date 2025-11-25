<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    {{-- B. HERO SECTION                --}}

    
    <section class="py-10">
        <div 
            x-data="{ activeSlide: 1, totalSlides: 3, autoplay: null }"
            x-init="autoplay = setInterval(() => { activeSlide = (activeSlide === totalSlides) ? 1 : activeSlide + 1 }, 5000)"
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative rounded-lg overflow-hidden shadow-lg h-[400px] md:h-[500px]">

            {{-- SLIDE 1 --}}
            <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="h-full w-full flex items-center justify-center relative">
                    <img src="{{ asset('storage/images/Frame 231.png') }}" class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>
            {{-- SLIDE 2 --}}
            <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="h-full w-full flex items-center justify-center relative">
                    <img src="{{ asset('storage/images/Frame 232.png') }}" class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="h-full w-full flex items-center justify-center relative">
                    <img src="{{ asset('storage/images/Frame 233.png') }}" class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>

        </div>
    </section>

    {{-- ============================== --}}
    {{-- C. FEATURED PRODUCTS (Grid)    --}}
    {{-- ============================== --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
{{-- LOGIKA JUDUL DINAMIS --}}
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    @if (request('category'))
                        Kategori: <span class="text-blue-600">{{ $categories->firstWhere('slug', request('category'))->name ?? request('category') }}</span>
                    @elseif (request('search'))
                        Hasil Pencarian: "<span class="text-blue-600">{{ request('search') }}</span>"
                    @else
                        Our Product
                    @endif
                </h2>

                {{-- Tombol Reset Filter (Muncul jika sedang search atau filter kategori) --}}
                @if (request('category') || request('search'))
                    <a href="{{ route('home') }}" class="text-sm font-medium text-red-500 hover:underline flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Reset Filter
                    </a>
                @endif
            </div>
            
            {{-- GRID PRODUK --}}
            <div class="grid ...">
               {{-- ... (looping produk Anda) ... --}}
                        
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
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="mt-4 w-full bg-white border border-gray-300 text-gray-700 font-semibold py-2 rounded-md hover:bg-gray-50 transition">
                                    Add to Cart
                                </button>
                            </form>
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