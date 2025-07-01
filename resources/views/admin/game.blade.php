@extends('layouts.app')

@section('title', 'Detail Game - Admin')

@section('content')
<!-- Tambahkan Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="max-w-5xl mx-auto px-6 py-10 bg-white rounded-lg shadow-md mt-10" x-data="{ openDeleteGame: false, reviewToDelete: null }">
    <h1 class="text-3xl font-bold text-[#5b63b7] mb-4">🎮 {{ $game['title'] }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <img src="{{ asset('images/games/' . $game['image']) }}" alt="Gambar Game" class="w-full h-64 object-cover rounded">
        </div>
        <div>
            <p><strong>Kode Game:</strong> {{ $game['gameCode'] }}</p>
            <p><strong>Genre:</strong> {{ $game['genre'] }}</p>
            <p><strong>Platform:</strong> {{ $game['platform'] }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($game['price'], 0, ',', '.') }}</p>
            <p><strong>Tanggal Rilis:</strong> {{ $game['releaseDate'] }}</p>
            <p><strong>Developer:</strong> {{ $game['developer'] }}</p>
            <p><strong>Publisher:</strong> {{ $game['publisher'] }}</p>
            <p><strong>Deskripsi:</strong> {{ $game['description'] }}</p>

            @if (!empty($game['videolink']))
            <div class="mt-4">
                <iframe width="100%" height="240" src="{{ $game['videolink'] }}" frameborder="0" allowfullscreen></iframe>
            </div>
            @endif

            <div class="mt-6 flex gap-4">
                <a href="{{ route('admin.game.edit', ['id' => $game['gameID']]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ✏️ Edit Game
                </a>
                <button @click="openDeleteGame = true" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    🗑️ Hapus Game
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Game -->
    <div x-show="openDeleteGame" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
        <div class="bg-white p-6 rounded shadow-md max-w-sm w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus Game</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus <strong>{{ $game['title'] }}</strong>?</p>

            <div class="flex justify-end gap-4">
                <button @click="openDeleteGame = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <form action="{{ route('admin.game.delete', ['id' => $game['gameID']]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- List Review --}}
    <div class="mt-10 max-w-4xl mx-auto">
        <h3 class="text-xl font-semibold mb-4 text-[#5b63b7]">Review dari Pengguna</h3>

        @if (!empty($reviews) && is_array($reviews) && count($reviews) > 0)
            <div class="space-y-4">
                @foreach ($reviews as $r)
                    @php
                        $username = $r['username'] ?? 'Anonim';
                        $date = \Carbon\Carbon::parse($r['Date'] ?? now())->translatedFormat('d F Y');
                        $text = $r['Text'] ?? '(Tidak ada isi)';
                        $rating = max(1, min(5, (int) ($r['Rating'] ?? 1)));
                        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                    @endphp

                    <div class="bg-white p-4 rounded shadow border border-gray-100">
                        <div class="flex justify-between text-sm text-gray-600 font-semibold mb-1">
                            <span>{{ $username }}</span>
                            <span>{{ $date }}</span>
                        </div>
                        <p class="text-gray-800 mb-2">{{ $text }}</p>
                        <p class="text-yellow-500 text-lg">{{ $stars }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Belum ada review.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-[#5b63b7] hover:underline">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection
