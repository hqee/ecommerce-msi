<x-admin-layout>
    <x-slot name="header">
        Kelola Produk
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        {{-- Tampilkan pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        {{-- Tombol Tambah Produk --}}
        <div class="mb-4">
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                + Tambah Produk Baru
            </a>
        </div>

        {{-- Tabel Produk --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left">Gambar</th>
                        <th class="py-3 px-4 text-left">Nama Produk</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Stok</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b">
                            <td class="py-3 px-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="py-3 px-4 font-semibold">{{ $product->name }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $product->stock }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-700 font-bold">Edit</a>
                                {{-- Tombol Hapus akan kita fungsikan nanti --}}
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold ml-4">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>