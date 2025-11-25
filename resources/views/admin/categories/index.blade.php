<x-admin-layout>
    <x-slot name="header">Kelola Kategori</x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                + Tambah Kategori
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Kategori</th>
                        <th class="py-3 px-4 text-left">Slug</th>
                        <th class="py-3 px-4 text-left">Jumlah Produk</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 font-semibold">{{ $category->name }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $category->slug }}</td>
                            <td class="py-3 px-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded">
                                    {{ $category->products->count() }} Produk
                                </span>
                            </td>
                            <td class="py-3 px-4 flex space-x-4">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-yellow-500 hover:text-yellow-700 font-bold">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-admin-layout>