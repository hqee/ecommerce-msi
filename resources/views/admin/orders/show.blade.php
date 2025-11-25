<x-admin-layout>
    <x-slot name="header">Detail Pesanan #{{ $order->id }}</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI: Detail Produk --}}
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Daftar Produk</h3>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500 text-sm">
                            <th class="pb-2">Produk</th>
                            <th class="pb-2">Harga</th>
                            <th class="pb-2">Qty</th>
                            <th class="pb-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <img src="{{ $item->product->image_url }}" class="w-12 h-12 object-cover rounded mr-3">
                                        <span>{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">Rp {{ number_format($item->price) }}</td>
                                <td class="py-3">x {{ $item->quantity }}</td>
                                <td class="py-3 text-right font-bold">Rp {{ number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="border-t pt-4 mt-4 space-y-2 text-right">
                    <p>Ongkir: <span class="font-bold">Rp {{ number_format($order->shipping_cost) }}</span></p>
                    <p class="text-xl font-bold text-blue-600">Total: Rp {{ number_format($order->total_amount) }}</p>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Info & Aksi --}}
        <div class="space-y-6">
            
            {{-- Info Pelanggan & Pengiriman --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Informasi Pesanan</h3>
                <div class="space-y-3 text-sm">
                    <p><span class="text-gray-500 block">Nama Pelanggan:</span> {{ $order->user->name }}</p>
                    <p><span class="text-gray-500 block">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="text-gray-500 block">Metode Pengiriman:</span> 
                        <span class="font-bold capitalize">{{ $order->delivery_method }}</span>
                    </p>
                    <p><span class="text-gray-500 block">Metode Pembayaran:</span> 
                        <span class="font-bold uppercase">{{ $order->payment_method }}</span>
                    </p>
                    <p><span class="text-gray-500 block">Tanggal Order:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            {{-- Bukti Pembayaran (Hanya jika QRIS) --}}
            @if ($order->payment_method === 'qris')
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">Bukti Pembayaran</h3>
                    @if ($order->payment_proof)
                        <a href="{{ Storage::url($order->payment_proof) }}" target="_blank">
                            <img src="{{ Storage::url($order->payment_proof) }}" alt="Bukti Bayar" class="w-full rounded-lg border hover:opacity-90 transition cursor-pointer">
                        </a>
                        <p class="text-xs text-gray-500 mt-2 text-center">Klik gambar untuk memperbesar</p>
                    @else
                        <p class="text-red-500 text-sm">Bukti pembayaran tidak ditemukan.</p>
                    @endif
                </div>
            @endif

            {{-- Update Status --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Update Status</h3>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mb-4">
                        <option value="pending" @selected($order->status == 'pending')>Pending</option>
                        <option value="paid" @selected($order->status == 'paid')>Paid (Sudah Bayar)</option>
                        <option value="shipped" @selected($order->status == 'shipped')>Shipped (Dikirim)</option>
                        <option value="completed" @selected($order->status == 'completed')>Completed (Selesai)</option>
                        <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled (Batal)</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                        Simpan Status
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-admin-layout>