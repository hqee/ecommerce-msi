{{-- Properti `show` akan kita kirim dari luar untuk mengontrol modal --}}
@props(['show' => false])

<div
    x-show="{{ $show }}"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>
    {{-- Kotak Modal Putih --}}
    <div
        x-show="{{ $show }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative w-full max-w-md bg-white rounded-lg shadow-xl p-6"
        @click.away="$dispatch('close')" {{-- Menutup modal jika klik di luar kotak --}}
    >
        {{-- Tombol Close (X) --}}
        <button
            @click="$dispatch('close')"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        {{-- Konten akan dimasukkan di sini --}}
        {{ $slot }}
    </div>
</div>