@extends('layouts.app')

@section('title', 'Game Store Dashboard')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-center mb-8 text-[#5b63b7]">Game Store Dashboard</h1>

    @if (empty($games))
        <p class="text-center text-red-500">Tidak ada data ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
            @foreach ($games as $game)
                <div class="bg-white rounded-2xl shadow-md p-6 border border-[#5b63b7] hover:shadow-lg transition duration-300">
                    <h2 class="text-xl font-semibold text-[#000000] mb-2">
                        {{ $game['title'] }} <span class="text-sm text-gray-500">({{ $game['gameCode'] }})</span>
                    </h2>
                    <p><span class="font-semibold">Genre:</span> {{ $game['genre'] }}</p>
                    <p><span class="font-semibold">Platform:</span> {{ $game['platform'] }}</p>
                    <p><span class="font-semibold">Price:</span> ${{ $game['price'] }}</p>
                    <p><span class="font-semibold">Release Date:</span> {{ $game['releaseDate'] }}</p>
                    <p><span class="font-semibold">Developer:</span> {{ $game['developer'] }}</p>
                    <p><span class="font-semibold">Publisher:</span> {{ $game['publisher'] }}</p>
                    <p class="mt-2 text-sm text-gray-600"><span class="font-semibold">Description:</span> {{ $game['description'] }}</p>
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
