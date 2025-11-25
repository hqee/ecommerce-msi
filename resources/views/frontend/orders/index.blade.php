<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 px-4 sm:px-0">Riwayat Pesanan Saya</h2>

            <div class="space-y-6 px-4 sm:px-0">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        {{-- Header Kartu --}}
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between sm:items-center">
                            <div class="mb-2 sm:mb-0">
                                <span class="text-sm text-gray-500">Tanggal Order</span>
                                <p class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="mb-2 sm:mb-0">
                                <span class="text-sm text-gray-500">Total Belanja</span>
                                <p class="font-semibold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Status</span>
                                <div>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                          ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                          ($order->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Body Kartu (Preview Item Pertama) --}}
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                {{-- Ambil gambar produk pertama sebagai preview --}}
                                @if($order->items->first())
                                    <img src="{{ $order->items->first()->product->image_url }}" alt="Product" class="w-16 h-16 object-cover rounded-md">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $order->items->first()->product->name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $order->items->count() > 1 ? '+ ' . ($order->items->count() - 1) . ' produk lainnya' : 'x ' . $order->items->first()->quantity }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('my-orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">
                                Lihat Detail Pesanan
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 rounded-lg shadow-sm text-center border border-gray-200">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <p class="text-gray-500 text-lg">Belum ada pesanan.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Mulai Belanja</a>
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>