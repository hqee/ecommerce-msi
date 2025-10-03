<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Breadcrumbs --}}
            <div class="text-sm breadcrumbs mb-4 px-4 sm:px-0">
                <ul>
                    <li><a href="{{ route('home') }}" class="hover:text-green-600">Home</a></li> 
                    <li><a href="#" class="hover:text-green-600">{{ $product->category->name }}</a></li> 
                    <li class="truncate">{{ $product->name }}</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    
                    {{-- KIRI: Galeri Gambar --}}
                    <div>
                        <div class="mb-4 border border-gray-200 rounded-lg">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                        </div>
                        {{-- Thumbnails --}}
                        <div class="flex space-x-2">
                            <img src="{{ $product->image_url }}" class="w-20 h-20 object-cover rounded-md border-2 border-green-500 cursor-pointer">
                            {{-- Ganti dengan gambar-gambar lain dari produk jika ada --}}
                            <img src="https://via.placeholder.com/100" class="w-20 h-20 object-cover rounded-md border cursor-pointer hover:border-green-500">
                            <img src="https://via.placeholder.com/100" class="w-20 h-20 object-cover rounded-md border cursor-pointer hover:border-green-500">
                            <img src="https://via.placeholder.com/100" class="w-20 h-20 object-cover rounded-md border cursor-pointer hover:border-green-500">
                        </div>
                    </div>

                    {{-- KANAN: Info Produk & Aksi --}}
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span>Terjual 1rb+</span>
                            <span class="mx-2">·</span>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="ml-1">5 (217 rating)</span>
                            </div>
                        </div>
                        <p class="text-3xl font-extrabold text-gray-900 mb-6">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="border-t border-b py-6">
                             {{-- Pilihan Varian --}}
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Pilih warna: <span class="font-semibold text-gray-900">Midnight</span></h3>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-1 text-sm border-2 border-green-500 text-green-600 rounded-lg font-semibold">Midnight</button>
                                    <button class="px-4 py-1 text-sm border border-gray-300 rounded-lg text-gray-500 hover:border-gray-500">Starlight</button>
                                </div>
                            </div>

                             {{-- Aksi Pembelian --}}
                            <div class="border rounded-lg p-4">
                                <p class="font-semibold mb-2 text-gray-800">Atur jumlah dan catatan</p>
                                <div class="flex items-center mb-4">
                                    <div class="flex items-center border rounded-lg">
                                        <button class="px-3 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">-</button>
                                        <input type="text" value="1" class="w-12 text-center border-l border-r focus:outline-none">
                                        <button class="px-3 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">+</button>
                                    </div>
                                    <p class="ml-4 text-sm text-gray-500">Stok: <span class="font-bold text-gray-700">{{ $product->stock }}</span></p>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="text-lg font-bold text-gray-800">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    {{-- Tombol + Keranjang sekarang ada di dalam form --}}
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        {{-- Anda bisa menambahkan input hidden untuk quantity jika diperlukan --}}
                                        {{-- <input type="hidden" name="quantity" value="1"> --}}
                                        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                                            + Keranjang
                                        </button>
                                    </form>

                                    <button class="w-full bg-green-50 text-green-600 font-bold py-3 rounded-lg hover:bg-green-100 border border-green-600 transition-colors">
                                        Beli Langsung
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail & Spesifikasi --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <a href="#" class="border-green-500 text-green-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Detail</a>
                            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Spesifikasi</a>
                        </nav>
                    </div>
                    <div class="py-6">
                        <h3 class="text-lg font-bold mb-2">Sekilas info Putra Group:</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        {{-- Tambahkan info lain di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>