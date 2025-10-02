<x-admin-layout>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card Total Products --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Products</p>
                {{-- Ganti 250 dengan data asli --}}
                <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
                {{-- Persentase bisa Anda hitung nanti --}}
                <p class="text-sm text-gray-400">All time</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
        {{-- Card Completed Order --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Completed Order</p>
                {{-- Ganti 124 dengan data asli --}}
                <p class="text-3xl font-bold text-gray-800">{{ $completedOrders }}</p>
                <p class="text-sm text-gray-400">All time</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Card Canceled Order --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Canceled Order</p>
                {{-- Ganti 14 dengan data asli --}}
                <p class="text-3xl font-bold text-gray-800">{{ $canceledOrders }}</p>
                <p class="text-sm text-gray-400">All time</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        {{-- Card Total Pengguna --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                {{-- Ganti Top products menjadi Total Pengguna --}}
                <p class="text-sm text-gray-500">Total User</p>
                {{-- Ganti 119 dengan data asli --}}
                <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                <p class="text-sm text-gray-400">All time</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
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