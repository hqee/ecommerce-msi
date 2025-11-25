<x-app-layout>
    @include('layouts.partials.frontend-navbar')

    <div class="py-12 bg-gray-50" x-data="checkoutData()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 px-4 sm:px-0">Checkout Pesanan</h1>

            <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- KOLOM KIRI: Detail Pengiriman & Pembayaran --}}
                    <div class="space-y-6 px-4 sm:px-0">
                        
                        {{-- 1. Metode Pengiriman --}}
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold mb-4">Metode Pengiriman</h2>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="delivery_method" value="pickup" x-model="deliveryMethod" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 flex-1">
                                        <span class="block font-medium text-gray-900">Ambil Langsung (Pickup)</span>
                                        <span class="block text-sm text-gray-500">Datang ke Toko Jaya Gemilang</span>
                                    </span>
                                    <span class="font-bold text-gray-700">Gratis</span>
                                </label>

                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="delivery_method" value="delivery" x-model="deliveryMethod" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-3 flex-1">
                                        <span class="block font-medium text-gray-900">Diantar (Delivery)</span>
                                        <span class="block text-sm text-gray-500">Kurir toko akan mengantar</span>
                                    </span>
                                    <span class="font-bold text-gray-700">Rp 5.000</span>
                                </label>
                            </div>
                        </div>

                        {{-- 2. Metode Pembayaran --}}
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="payment_method" value="cash" x-model="paymentMethod" class="text-green-600 focus:ring-green-500">
                                    <span class="ml-3 font-medium text-gray-900">Cash (Tunai)</span>
                                </label>

                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input type="radio" name="payment_method" value="qris" x-model="paymentMethod" class="text-green-600 focus:ring-green-500">
                                    <span class="ml-3 font-medium text-gray-900">QRIS (Scan & Upload)</span>
                                </label>
                            </div>

                            {{-- Area Upload Bukti QRIS (Muncul hanya jika pilih QRIS) --}}
                            <div x-show="paymentMethod === 'qris'" class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-100" style="display: none;">
                                <p class="text-sm text-blue-800 mb-2 font-semibold">Silakan Scan QRIS di bawah ini:</p>
                                {{-- Ganti dengan gambar QRIS asli Anda --}}
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Code" class="w-32 h-32 mb-4 bg-white p-2 rounded">
                                
                                <label class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran</label>
                                <input type="file" name="payment_proof" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>

                    </div>

                    {{-- KOLOM KANAN: Ringkasan Biaya --}}
                    <div class="px-4 sm:px-0">
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 sticky top-24">
                            <h2 class="text-lg font-semibold mb-4">Ringkasan Biaya</h2>
                            
                            <div class="flex justify-between mb-2 text-gray-600">
                                <span>Subtotal Produk</span>
                                <span>Rp <span x-text="formatRupiah(subtotal)"></span></span>
                            </div>

                            <div class="flex justify-between mb-2 text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span x-text="deliveryMethod === 'delivery' ? 'Rp 5.000' : 'Gratis'"></span>
                            </div>

                            <div class="border-t border-gray-200 my-4"></div>

                            <div class="flex justify-between mb-6">
                                <span class="text-lg font-bold text-gray-800">Total Bayar</span>
                                <span class="text-lg font-bold text-blue-600">Rp <span x-text="formatRupiah(calculateTotal())"></span></span>
                            </div>

                            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors">
                                Buat Pesanan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function checkoutData() {
            return {
                deliveryMethod: 'pickup', // Default
                paymentMethod: 'cash',    // Default
                subtotal: {{ $subtotal }}, // Diambil dari Controller

                calculateTotal() {
                    let shipping = (this.deliveryMethod === 'delivery') ? 5000 : 0;
                    return this.subtotal + shipping;
                },

                formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID').format(angka);
                }
            }
        }
    </script>
</x-app-layout>