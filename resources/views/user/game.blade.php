@extends('layouts.app')

@section('title', e($game['title']))

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-2xl shadow-lg mt-10">
    {{-- Judul --}}
    <h1 class="text-3xl font-bold text-center mb-8 text-[#5b63b7]">{{ e($game['title']) }}</h1>

    {{-- Gambar Game --}}
    <div class="flex justify-center mb-8">
        <img 
            src="{{ !empty($game['image']) 
                ? asset('images/games/' . $game['image']) 
                : asset('images/games/default.png') }}"
            alt="{{ $game['title'] ?? 'Game Image' }}"
            class="w-full max-w-xs rounded-lg shadow-md object-cover">
    </div>

    {{-- Informasi Game --}}
    <div class="space-y-4 text-base text-gray-800">
        <p><span class="font-semibold text-black">Kode Game:</span> {{ e($game['gameCode']) }}</p>
        <p><span class="font-semibold text-black">Genre:</span> {{ e($game['genre']) }}</p>
        <p><span class="font-semibold text-black">Platform:</span> {{ e($game['platform']) }}</p>
        <p><span class="font-semibold text-black">Harga:</span> ${{ number_format($game['price'], 2) }}</p>
        <p><span class="font-semibold text-black">Rilis:</span> {{ e($game['releaseDate']) }}</p>
        <p><span class="font-semibold text-black">Developer:</span> {{ e($game['developer']) }}</p>
        <p><span class="font-semibold text-black">Publisher:</span> {{ e($game['publisher']) }}</p>
        <p><span class="font-semibold text-black">Deskripsi:</span> {{ e($game['description']) }}</p>
    </div>

    {{-- Trailer --}}
    @if (!empty($game['videolink']))
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2 text-[#5b63b7]">🎬 Trailer</h3>
            <div class="aspect-w-16 aspect-h-9">
                <iframe 
                    src="{{ $game['videolink'] }}" 
                    width="100%" height="400"
                    frameborder="0" allowfullscreen
                    class="rounded-lg w-full">
                </iframe>
            </div>
        </div>
    @endif

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

    {{-- Feedback pesan --}}
    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="text-red-600 mb-4">{{ session('error') }}</p>
    @endif

    <form action="{{ route('user.review.store', $game['gameID']) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Text Review --}}
        <div>
            <label for="text" class="block font-semibold mb-1">Review</label>
            <textarea name="text" id="text" rows="4" placeholder="Tulis review kamu..." class="w-full border rounded p-2" required>{{ old('text') }}</textarea>
            @error('text') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Rating Bintang --}}
        <div>
            <label class="block font-semibold mb-1">Rating</label>
            <div id="star-container" class="flex space-x-1 text-2xl cursor-pointer text-gray-400">
                @for ($i = 1; $i <= 5; $i++)
                    <span data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="{{ old('rating', 0) }}">
            @error('rating') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Submit --}}
        <button type="submit" class="bg-[#5b63b7] text-white px-4 py-2 rounded hover:bg-[#434bac]">
            Kirim Review
        </button>
    </form>
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

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-container span');
        const ratingInput = document.getElementById('rating');

        // Jika ada nilai rating lama (misal dari old value)
        const oldValue = parseInt(ratingInput.value || 0);
        highlightStars(oldValue);

        stars.forEach((star) => {
            star.addEventListener('click', () => {
                const ratingValue = parseInt(star.getAttribute('data-value'));
                ratingInput.value = ratingValue;
                highlightStars(ratingValue);
            });
        });

        function highlightStars(count) {
            stars.forEach((s, i) => {
                s.classList.toggle('text-yellow-400', i < count);
                s.classList.toggle('text-gray-400', i >= count);
            });
        }
    });
</script>
