<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    {{-- 1. Headline & Statistik --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-bold text-gray-800">👋 “Selamat Datang, {{ Auth::user()->name }}!”</h2>
        <p class="mt-2 text-gray-600">📊 Pantau penjualan, kelola produk, dan kendalikan toko Anda dengan mudah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card 1: Total Pendapatan --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>
            </div>
        </div>

        {{-- Card 2: Total Order --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>

        {{-- Card 3: Pesanan Selesai --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pesanan Selesai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $completedOrders }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        {{-- Card 4: Total Produk --}}
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- 2. Grafik Penjualan --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-4">Laporan Penjualan ({{ date('Y') }})</h3>
            <div class="relative h-80 w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        {{-- 3. Stok Menipis & Produk Terlaris --}}
        <div class="space-y-6">
            {{-- Stok Menipis --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-red-600 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Stok Menipis (< 5)
                </h3>
                <div class="space-y-3">
                    @forelse($lowStockProducts as $product)
                        <div class="flex justify-between items-center border-b pb-2 last:border-0">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-700 truncate w-40">{{ $product->name }}</span>
                            </div>
                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full">
                                Sisa: {{ $product->stock }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Aman, stok semua produk cukup.</p>
                    @endforelse
                </div>
            </div>

            {{-- Produk Terlaris --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">🔥 Produk Terlaris</h3>
                <div class="space-y-4">
                    @forelse($topProducts as $index => $product)
                        <div class="flex items-center justify-between border-b pb-2 last:border-0">
                            <div class="flex items-center">
                                <span class="text-gray-400 font-bold mr-3">#{{ $index + 1 }}</span>
                                <span class="text-sm font-medium text-gray-800 truncate w-32">{{ $product->name }}</span>
                            </div>
                            <span class="text-sm font-bold text-gray-600">{{ $product->total_sold }} Terjual</span>
                        </div>
                    @empty
                         <p class="text-sm text-gray-500">Belum ada data penjualan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Tabel Transaksi Terakhir --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Transaksi Terakhir</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-500 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestOrders as $order)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">#{{ $order->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $order->user->name ?? 'User Hapus' }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="px-2 py-1 text-xs font-bold rounded-full 
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                      ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    const salesData = @json($salesData);
    const salesLabels = @json($salesLabels);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: salesData,
                backgroundColor: '#3B82F6',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: function(value) { return 'Rp ' + (value/1000).toLocaleString() + 'k'; } }
                }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endpush