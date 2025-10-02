<x-admin-layout>
    {{-- Kita tidak perlu <x-slot name="header"> karena header sudah ada di layout --}}

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card Total Products --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total products</p>
                <p class="text-3xl font-bold text-gray-800">250</p>
                <p class="text-sm text-green-500">+2.5%</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
        {{-- Card Completed Order --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Completed order</p>
                <p class="text-3xl font-bold text-gray-800">124</p>
                <p class="text-sm text-green-500">+2.5%</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Card Canceled Order --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Canceled order</p>
                <p class="text-3xl font-bold text-gray-800">14</p>
                <p class="text-sm text-red-500">-1.5%</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Card Top Products --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Top products</p>
                <p class="text-3xl font-bold text-gray-800">119</p>
                <p class="text-sm text-green-500">+2.5%</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
            </div>
        </div>
    </div>
    
    {{-- Placeholder untuk Grafik & Tabel --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold">Your sales report</h3>
        <p class="text-gray-500 mt-2">Grafik penjualan akan ditampilkan di sini.</p>
    </div>
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold">Last transaction</h3>
        <p class="text-gray-500 mt-2">Tabel transaksi terakhir akan ditampilkan di sini.</p>
    </div>

</x-admin-layout>