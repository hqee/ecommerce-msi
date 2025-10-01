<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2">Ini adalah halaman utama untuk panel admin.</p>
                </div>
            </div>

            {{-- Contoh Kartu Statistik --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kartu Jumlah Produk -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold">Jumlah Produk</h4>
                        <p class="text-3xl font-bold mt-2">150</p> {{-- Ganti dengan data asli nanti --}}
                    </div>
                </div>
                <!-- Kartu Jumlah User -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold">Jumlah Pengguna</h4>
                        <p class="text-3xl font-bold mt-2">11</p> {{-- Ganti dengan data asli nanti --}}
                    </div>
                </div>
                <!-- Kartu Pendapatan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold">Total Pesanan</h4>
                        <p class="text-3xl font-bold mt-2">52</p> {{-- Ganti dengan data asli nanti --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>