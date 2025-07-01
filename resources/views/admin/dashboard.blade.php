@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center mb-10 text-[#5b63b7]">Dashboard Admin - Game Store</h1>

    <a href="{{ url('/admin/game/create') }}"
       class="mb-6 inline-block bg-[#5b63b7] text-white px-6 py-2 rounded hover:bg-[#434bac] transition">
        + Tambah Game
    </a>

    @if (!is_array($game) || count($game) === 0)
        <p class="text-center text-red-500 text-lg">Tidak ada data game.</p>
    @else
        @php $game = is_assoc($game) ? [$game] : $game; @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($game as $game)
                <div class="bg-white border shadow rounded-xl overflow-hidden">
                    <img src="{{ asset('images/games/' . ($game['image'] ?? 'default.png')) }}"
                         class="w-full h-40 object-cover">

                    <div class="p-4 space-y-1">
                        <h2 class="text-xl font-bold text-[#5b63b7]">{{ $game['title'] }}</h2>
                        <p><strong>Platform:</strong> {{ $game['platform'] }}</p>
                        <p><strong>Genre:</strong> {{ $game['genre'] }}</p>
                        <p><strong>Harga:</strong> ${{ number_format($game['price'], 2) }}</p>

                        <div class="mt-3 flex gap-2">
                            <a href="{{ url('/admin/game/' . $game['gameID']) }}"
                               class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Detail</a>
                            <a href="{{ url('/admin/game/edit/' . $game['gameID']) }}"
                               class="px-3 py-1 bg-yellow-400 text-black text-sm rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ url('/admin/game/delete/' . $game['gameID']) }}" method="POST"
                                  onsubmit="return confirm('Hapus game ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
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
