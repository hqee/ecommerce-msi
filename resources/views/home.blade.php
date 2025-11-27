<x-app-layout>
    @include('layouts.partials.frontend-navbar')
    
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
                        Etalase Produk
                    @endif
                </h2>

                {{-- Tombol Reset Filter --}}
                @if (request('category') || request('search'))
                    <a href="{{ route('home') }}" class="text-sm font-medium text-red-500 hover:underline flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Reset Filter
                    </a>
                @endif
            </div>
            
            {{-- GRID PRODUK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    {{-- CARD PRODUK (Hanya 1 Blok) --}}
                    <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                        
                        {{-- Area Gambar --}}
                        <div class="aspect-w-1 aspect-h-1 bg-gray-50 group-hover:opacity-75 relative overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-50 object-cover object-center">
                        </div>

                        {{-- TOMBOL WISHLIST (LOVE) --}}
                        @auth
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="absolute top-3 right-3 p-2 rounded-full transition z-20 {{ $product->is_favorited ? 'bg-red-50 text-red-500' : 'bg-white/70 text-gray-400 hover:text-red-500' }} backdrop-blur-sm shadow-sm">
                                    @if($product->is_favorited)
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="absolute top-3 right-3 bg-white/70 backdrop-blur-sm p-2 rounded-full text-gray-400 hover:text-red-500 transition z-20 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                            </a>
                        @endauth

                        {{-- Area Info Produk --}}
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-md font-semibold text-gray-800">
                                        {{-- Link Utama (Overlay) --}}
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <span aria-hidden="true" class="absolute inset-0 z-10"></span>
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                                </div>
                            
                                <p class="text-md font-medium text-gray-900">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Tombol Add to Cart --}}
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="relative z-20 mt-auto">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full block text-center bg-white border border-gray-300 text-gray-700 font-semibold py-2 rounded-md hover:bg-gray-50 hover:border-gray-400 hover:text-gray-900 transition cursor-pointer shadow-sm">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada produk</h3>
                        <p class="mt-1 text-sm text-gray-500">Maaf, belum ada produk yang tersedia saat ini.</p>
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
