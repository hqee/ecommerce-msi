<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h2 class="text-3xl font-bold text-gray-800 mb-8 px-4 sm:px-0">Produk Favorit Saya </h2>

            {{-- GRID PRODUK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 sm:px-0">
                @forelse ($wishlists as $item)
                    {{-- Kita ambil object product dari relasi --}}
                    @php $product = $item->product; @endphp

                    <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                        {{-- Area Gambar --}}
                        <div class="aspect-w-1 aspect-h-1 bg-gray-50 group-hover:opacity-75 relative overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-50 object-cover object-center">
                        </div>

                        {{-- Tombol Hapus dari Wishlist --}}
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="absolute top-3 right-3 p-2 rounded-full transition z-20 bg-red-50 text-red-500 backdrop-blur-sm shadow-sm hover:bg-red-100" title="Hapus dari Favorit">
                                {{-- Ikon Hati Full (karena ini halaman favorit) --}}
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>

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
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada produk favorit</h3>
                        <p class="mt-1 text-sm text-gray-500">Simpan barang yang Anda suka di sini.</p>
                        <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Cari Produk</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 px-4 sm:px-0">
                {{ $wishlists->links() }}
            </div>
        </div>
    </div>
</x-app-layout>