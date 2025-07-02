@extends('layouts.app')

@section('title', 'Game Store Dashboard')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center mb-10 text-[#5b63b7]">Game Store Dashboard</h1>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ url('/user/dashboard') }}" class="mb-10 max-w-2xl mx-auto flex flex-col sm:flex-row gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari judul, genre, atau platform..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5b63b7]">
        <button type="submit" class="bg-[#5b63b7] text-white px-6 py-2 rounded-md hover:bg-[#434bac] transition">
            Cari
        </button>
    </form>

    @if (!is_array($games) || count($games) === 0)
        <p class="text-center text-red-500 text-lg">Tidak ada data ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        <p class="text-center text-sm text-gray-600 mb-6">Ditemukan {{ count($games) }} game.</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($games as $game)
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-200 hover:shadow-xl transition duration-300 transform hover:scale-[1.02] w-fit mx-auto">
                    {{-- Gambar Game --}}
                    <div style="text-align: center;">
                        <img src="{{ asset('images/games/' . ($game['image'] ?? 'default.png')) }}"
                             onerror="this.src='{{ asset('images/games/default.png') }}'"
                             alt="{{ $game['title'] }}"
                             style="width: 300px; height: 400px; object-fit: cover; border-radius: 8px;">
                    </div>

                    <div class="p-5 break-words">
                        <h2 class="text-lg font-bold text-[#000000] mb-2">
                            <a href="{{ url('/user/game/' . $game['gameID']) }}" class="text-[#5b63b7] hover:underline">
                                {{ $game['title'] }}
                            </a>
                            <span class="text-sm text-gray-500">({{ $game['gameCode'] }})</span>
                        </h2>

                        <ul class="text-sm text-gray-700 space-y-1">
                            <li><span class="font-medium">Genre:</span> {{ $game['genre'] }}</li>
                            <li><span class="font-medium">Platform:</span> {{ $game['platform'] }}</li>
                            <li><span class="font-medium">Harga:</span> ${{ $game['price'] }}</li>
                            <li><span class="font-medium">Rilis:</span> {{ $game['releaseDate'] }}</li>
                            <li><span class="font-medium">Developer:</span> {{ $game['developer'] }}</li>
                            <li><span class="font-medium">Publisher:</span> {{ $game['publisher'] }}</li>
                        </ul>

                        <p class="mt-3 text-sm text-gray-600">
                            <span class="font-medium">Deskripsi:</span>
                            {{ \Illuminate\Support\Str::limit($game['description'], 120) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@php
    function is_assoc($arr) {
        return is_array($arr) && array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp
