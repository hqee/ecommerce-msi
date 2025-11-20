<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Your Cart</h3>

            @if ($cart && $cart->items->isNotEmpty())
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Kiri: Daftar Item --}}
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($cart->items as $item)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center justify-between space-x-6">
                                {{-- Kiri: Gambar & Info Produk --}}
                                <div class="flex items-center space-x-4 flex-grow-0">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-md">
                                    <div>
                                        <h2 class="font-semibold text-lg text-gray-800">{{ $item->product->name }}</h2>
                                        <p class="text-sm text-green-600">In stock</p>
                                        {{-- Harga Satuan (Opsional, jika ingin ditampilkan terpisah) --}}
                                        {{-- <p class="text-sm text-gray-500 mt-1">Rp{{ number_format($item->product->price) }}</p> --}}
                                    </div>
                                </div>

                                {{-- Tengah-Kanan: Harga Satuan --}}
                                <div class="flex-grow text-right pr-4 hidden sm:block"> {{-- Hidden on small screens --}}
                                    <p class="text-gray-700">Rp{{ number_format($item->product->price) }}</p>
                                </div>

                                {{-- Paling Kanan: Quantity Control, Total Harga Item, dan Tombol Hapus --}}
                                <div class="flex items-center space-x-4 flex-shrink-0">
                                    {{-- Quantity Control --}}
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center border border-gray-300 rounded-md">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit();" class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-l-md">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-12 text-center border-l border-r border-gray-300 focus:outline-none" onchange="this.parentNode.submit()">
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit();" class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-r-md">+</button>
                                    </form>

                                    {{-- Total Harga Item --}}
                                    <p class="font-bold text-lg text-gray-800 w-32 text-right">Rp{{ number_format($item->product->price * $item->quantity) }}</p>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Kolom Kanan: Ringkasan --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 h-fit">
                        <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span>Item Subtotal</span>
                                <span>Rp{{ number_format($subtotal) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Diskon</span>
                                <span class="text-red-500">- Rp0</span>
                            </div>
                            <div class="border-t my-2"></div>
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span>Rp{{ number_format($subtotal) }}</span>
                            </div>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-6 w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors text-lg">
                            Proceed to checkout
                        </button>
                    </form>

                    </div>
                </div>
            @else
                {{-- Tampilan Keranjang Kosong --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                    <h2 class="text-2xl font-bold mb-2">Keranjang Anda Kosong</h2>
                    <p class="text-gray-500 mb-6">Sepertinya Anda belum menambahkan produk apa pun.</p>
                    <a href="{{ route('home') }}" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors">
                        Lanjut Berbelanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>