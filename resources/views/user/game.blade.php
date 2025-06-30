@extends('layouts.app')

@section('title', $game['title'])

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-lg mt-10">
    {{-- Judul --}}
    <h1 class="text-3xl font-bold text-center mb-8 text-[#5b63b7]">{{ $game['title'] }}</h1>

    {{-- Gambar Game --}}
    <div class="flex justify-center mb-8">
        <img 
            src="{{ !empty($game['image']) 
                ? asset('images/games/' . $game['image']) 
                : asset('images/games/default.png') }}"
            alt="{{ $game['title'] }}"
            class="w-full max-w-xs rounded-lg shadow-md object-cover">
    </div>

    {{-- Informasi Game --}}
    <div class="space-y-4 text-base text-gray-800">
        <p><span class="font-semibold text-black">Kode Game:</span> {{ $game['gameCode'] }}</p>
        <p><span class="font-semibold text-black">Genre:</span> {{ $game['genre'] }}</p>
        <p><span class="font-semibold text-black">Platform:</span> {{ $game['platform'] }}</p>
        <p><span class="font-semibold text-black">Harga:</span> ${{ $game['price'] }}</p>
        <p><span class="font-semibold text-black">Rilis:</span> {{ $game['releaseDate'] }}</p>
        <p><span class="font-semibold text-black">Developer:</span> {{ $game['developer'] }}</p>
        <p><span class="font-semibold text-black">Publisher:</span> {{ $game['publisher'] }}</p>
        <p><span class="font-semibold text-black">Deskripsi:</span> {{ $game['description'] }}</p>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-center">
        <a href="{{ route('user.dashboard') }}"
           class="inline-block bg-[#5b63b7] hover:bg-[#434bac] text-white px-6 py-2 rounded-md transition">
            ← Kembali ke Daftar Game
        </a>
    </div>
</div>

{{-- Review Form --}}
<div class="mt-10 max-w-4xl mx-auto bg-gray-50 p-6 rounded-lg border border-gray-200">
    <h3 class="text-xl font-semibold mb-4 text-[#5b63b7]">Tulis Review</h3>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="text-red-600 mb-4">{{ session('error') }}</p>
    @endif

    <form action="{{ route('user.review.store', $game['gameID']) }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="title" placeholder="Judul Review" class="w-full border rounded p-2" required>
        <textarea name="text" rows="4" placeholder="Tulis review kamu..." class="w-full border rounded p-2" required></textarea>
        <label class="block">
            <span class="font-semibold">Rating (1 - 5):</span>
            <input type="number" name="rating" min="1" max="5" class="border rounded p-2 w-24" required>
        </label>
        <button type="submit" class="bg-[#5b63b7] text-white px-4 py-2 rounded hover:bg-[#434bac]">
            Kirim Review
        </button>
    </form>
</div>

{{-- List Review --}}
<div class="mt-10 max-w-4xl mx-auto">
    <h3 class="text-xl font-semibold mb-4 text-[#5b63b7]">Review dari Pengguna</h3>
    <div id="review-section" class="space-y-4">
        <p class="text-gray-500">Loading review...</p>
    </div>
</div>

{{-- AJAX Review Load --}}
<script>
    fetch(`{{ route('user.review.index', $game['gameID']) }}`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('review-section');
            container.innerHTML = '';

            if (data.length === 0) {
                container.innerHTML = '<p class="text-gray-500">Belum ada review.</p>';
            } else {
                data.forEach(r => {
                    const stars = '★'.repeat(r.Rating) + '☆'.repeat(5 - r.Rating);
                    container.innerHTML += `
                        <div class="bg-white p-4 rounded shadow border border-gray-100">
                            <p class="text-sm text-gray-700 mb-1"><strong>${r.username}</strong> - ${r.Date}</p>
                            <p class="text-yellow-500 mb-1">${stars}</p>
                            <p class="font-semibold">${r.title}</p>
                            <p class="text-gray-600">${r.Text}</p>
                        </div>`;
                });
            }
        }).catch(() => {
            const container = document.getElementById('review-section');
            container.innerHTML = '<p class="text-red-500">Gagal memuat review.</p>';
        });
</script>
@endsection
