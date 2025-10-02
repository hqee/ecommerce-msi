<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100">
        {{-- ============================== --}}
        {{--         SIDEBAR KIRI           --}}
        {{-- ============================== --}}
        @include('layouts.partials.admin-sidebar')

        {{-- ============================== --}}
        {{--      KONTEN UTAMA (KANAN)      --}}
        {{-- ============================== --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- HEADER KONTEN --}}
            <header class="flex justify-between items-center p-6 bg-white border-b border-gray-200">
                {{-- Kiri: Judul Halaman --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Good Morning, {{ Auth::user()->name }}!</h1>
                    <p class="text-sm text-gray-500">Here's what's happening with your store today</p>
                </div>

                {{-- Kanan: Tanggal & Dropdown User --}}
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ now()->format('d M Y') }}</span>

                    {{-- Dropdown User Dimulai di Sini --}}
                    <div x-data="{ open: false }" class="relative">
                        {{-- Tombol untuk membuka dropdown --}}
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                            {{-- Ikon User --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{-- Nama User --}}
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            {{-- Ikon Panah Dropdown --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        {{-- Konten Dropdown --}}
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            {{-- Info Pengguna --}}
                            <div class="px-4 py-2 text-sm text-gray-700">
                                <div class="font-medium">Signed in as</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="border-t border-gray-100"></div>

                            {{-- Link Profile --}}
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            {{-- Form Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- AREA KONTEN UTAMA --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>