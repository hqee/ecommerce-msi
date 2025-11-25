<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-500 mb-6 px-4 sm:px-0">
                <a href="{{ route('my-orders.index') }}" class="hover:text-blue-600">Riwayat Pesanan</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span>Detail Pesanan #{{ $order->id }}</span>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Pesanan #{{ $order->id }}</h1>
                        <p class="text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="px-3 py-1 text-sm font-bold rounded-full 
                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                          ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Produk Dibeli</h3>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center border-b border-gray-100 pb-4 last:border-0">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $item->product->image_url }}" class="w-16 h-16 object-cover rounded-md">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price) }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Rincian Pembayaran</h3>
                        <div class="flex justify-between text-gray-600 mb-2">
                            <span>Metode Pembayaran</span>
                            <span class="font-medium capitalize">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-2">
                            <span>Pengiriman</span>
                            <span class="font-medium capitalize">{{ $order->delivery_method }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-2">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($order->shipping_cost) }}</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-gray-800 mt-4 pt-4 border-t border-gray-100">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>