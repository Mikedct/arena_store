@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-center text-[#5b63b7] mb-8">Dashboard Admin - Game Store</h1>

    <div class="flex justify-center mb-6">
        <form method="GET" action="{{ url('/admin/dashboard') }}" class="flex gap-3 w-full max-w-xl">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari judul, genre, atau platform..."
                   class="w-full px-4 py-2 rounded border border-gray-300 focus:ring focus:ring-[#5b63b7] focus:outline-none">
            <button type="submit"
                    class="px-5 py-2 bg-[#5b63b7] text-white rounded hover:bg-[#454da1] transition">
                Cari
            </button>
        </form>
    </div>

    @if (empty($games))
        <p class="text-center text-red-500">Tidak ada data game ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($games as $game)
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-5 hover:shadow-lg transition">
                    @if (!empty($game['image']))
                        <img src="{{ asset('images/games/' . $game['image']) }}" alt="{{ $game['title'] }}"
                             class="w-full h-40 object-cover rounded-md mb-4">
                    @else
                        <img src="{{ asset('images/games/default.png') }}" alt="Default"
                             class="w-full h-40 object-cover rounded-md mb-4">
                    @endif

                    <h2 class="text-xl font-semibold text-[#000000] mb-1">
                        {{ $game['title'] }} <span class="text-sm text-gray-500">({{ $game['gameCode'] }})</span>
                    </h2>
                    <p><span class="font-semibold">Genre:</span> {{ $game['genre'] }}</p>
                    <p><span class="font-semibold">Platform:</span> {{ $game['platform'] }}</p>
                    <p><span class="font-semibold">Harga:</span> ${{ $game['price'] }}</p>
                    <p><span class="font-semibold">Rilis:</span> {{ $game['releaseDate'] }}</p>
                    <p><span class="font-semibold">Developer:</span> {{ $game['developer'] }}</p>
                    <p><span class="font-semibold">Publisher:</span> {{ $game['publisher'] }}</p>
                    <p class="text-sm mt-2 text-gray-600"><span class="font-semibold">Deskripsi:</span> {{ $game['description'] }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@php
    function is_assoc(array $arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp
