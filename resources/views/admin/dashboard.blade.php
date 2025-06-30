@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#5b63b7]">Dashboard Admin - Game Store</h1>
        <a href="{{ url('/admin/game/create') }}" class="bg-[#5b63b7] text-white px-4 py-2 rounded hover:bg-[#454da1] transition">
            + Tambah Game
        </a>
    </div>

    <form method="GET" action="{{ url('/user/dashboard') }}" class="mb-6 max-w-xl mx-auto flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari judul, genre, atau platform..."
            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#5b63b7]">
        <button type="submit" class="bg-[#5b63b7] text-white px-4 py-2 rounded hover:bg-[#3c4499]">
            Cari
        </button>
    </form>


    @if (empty($games))
        <p class="text-center text-red-500">Tidak ada data game ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($games as $game)
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-5 hover:shadow-lg transition relative">
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
                    <p><strong>Genre:</strong> {{ $game['genre'] }}</p>
                    <p><strong>Platform:</strong> {{ $game['platform'] }}</p>
                    <p><strong>Harga:</strong> ${{ $game['price'] }}</p>
                    <p><strong>Rilis:</strong> {{ $game['releaseDate'] }}</p>
                    <p><strong>Developer:</strong> {{ $game['developer'] }}</p>
                    <p><strong>Publisher:</strong> {{ $game['publisher'] }}</p>
                    <p class="text-sm mt-2 text-gray-600"><strong>Deskripsi:</strong> {{ $game['description'] }}</p>

                    <div class="mt-4 flex justify-between gap-2">
                        <a href="{{ url('/admin/game/edit/' . $game['gameID']) }}"
                           class="bg-yellow-400 text-black px-4 py-1 rounded hover:bg-yellow-500 transition text-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ url('/admin/game/delete/' . $game['gameID']) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus game ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition text-sm">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@php
    function is_assoc(array $arr) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp
