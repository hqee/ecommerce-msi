<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jual Beli Mudah dan Terpercaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold mb-6 text-gray-800">Produk Terbaru 🔥</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition duration-300 overflow-hidden">
                        
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-500 text-sm">Gambar Produk</span>
                        </div>
                        
                        <div class="p-4">
                            <p class="text-xs font-medium text-blue-600 uppercase">{{ $product->category->name }}</p>
                            <h4 class="text-lg font-semibold mt-1 truncate">{{ $product->name }}</h4>
                            <p class="text-xl font-bold text-red-600 mt-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">Stok: {{ $product->stock }}</p>
                            
                            <a href="#" class="mt-4 w-full block text-center bg-green-500 text-white font-medium py-2 rounded hover:bg-green-600 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>