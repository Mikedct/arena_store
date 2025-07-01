@extends('layouts.app')

@section('title', 'Detail Game Admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-[#5b63b7] mb-4">{{ $game['title'] }}</h1>

    <div class="flex flex-col md:flex-row gap-6 mb-6">
        <img src="{{ asset('images/games/' . ($game['image'] ?? 'default.png')) }}"
             class="w-full md:w-1/3 rounded shadow">

        <div class="flex-1 space-y-2">
            <p><strong>Genre:</strong> {{ $game['genre'] }}</p>
            <p><strong>Platform:</strong> {{ $game['platform'] }}</p>
            <p><strong>Harga:</strong> ${{ number_format($game['price'], 2) }}</p>
            <p><strong>Rilis:</strong> {{ $game['releaseDate'] }}</p>
            <p><strong>Developer:</strong> {{ $game['developer'] }}</p>
            <p><strong>Publisher:</strong> {{ $game['publisher'] }}</p>
            <p><strong>Deskripsi:</strong> {{ $game['description'] }}</p>
        </div>
    </div>

    <div class="mb-6 flex gap-3">
        <a href="{{ url('/admin/game/edit/' . $game['gameID']) }}"
           class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500">✏️ Edit Game</a>
        <form action="{{ url('/admin/game/delete/' . $game['gameID']) }}" method="POST"
              onsubmit="return confirm('Yakin hapus game ini?')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">🗑️ Hapus Game</button>
        </form>
    </div>

    {{-- Review Section --}}
    <h2 class="text-2xl font-semibold text-[#5b63b7] mb-4">Review Pengguna</h2>
    @if (!empty($review) && count($review))
        <div class="space-y-4">
            @foreach ($review as $review)
                <div class="bg-white p-4 border rounded shadow">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span><strong>{{ $review['username'] ?? 'Anonim' }}</strong></span>
                        <span>{{ \Carbon\Carbon::parse($review['Date'])->format('d M Y') }}</span>
                    </div>
                    <p class="text-gray-800 mt-1">{{ $review['Text'] }}</p>
                    <p class="text-yellow-500 mt-1 text-lg">
                        {{ str_repeat('★', $review['Rating']) . str_repeat('☆', 5 - $review['Rating']) }}
                    </p>
                    <div class="mt-2 flex gap-2">
                        <a href="{{ url('/admin/review/edit/' . $review['reviewID']) }}"
                           class="text-blue-600 hover:underline">✏️ Edit</a>
                        <form action="{{ url('/admin/review/delete/' . $review['reviewID']) }}" method="POST"
                              onsubmit="return confirm('Hapus review ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada review.</p>
    @endif
</div>
@endsection
