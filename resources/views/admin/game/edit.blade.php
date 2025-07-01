@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-lg shadow-md mt-10">
    <h1 class="text-2xl font-bold text-center text-[#5b63b7] mb-6">✏️ Edit Game</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/game/edit/' . $game['gameID']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4">
            <input type="hidden" name="adminID" value="{{ session('adminID') }}">

            <div>
                <label for="gameCode" class="block font-semibold">Kode Game</label>
                <input type="text" name="gameCode" value="{{ old('gameCode', $game['gameCode']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="title" class="block font-semibold">Judul</label>
                <input type="text" name="title" value="{{ old('title', $game['title']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="genre" class="block font-semibold">Genre</label>
                <input type="text" name="genre" value="{{ old('genre', $game['genre']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="platform" class="block font-semibold">Platform</label>
                <input type="text" name="platform" value="{{ old('platform', $game['platform']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="price" class="block font-semibold">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $game['price']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="releaseDate" class="block font-semibold">Tanggal Rilis</label>
                <input type="date" name="releaseDate" value="{{ old('releaseDate', $game['releaseDate']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="developer" class="block font-semibold">Developer</label>
                <input type="text" name="developer" value="{{ old('developer', $game['developer']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="publisher" class="block font-semibold">Publisher</label>
                <input type="text" name="publisher" value="{{ old('publisher', $game['publisher']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="description" class="block font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $game['description']) }}</textarea>
            </div>

            <div>
                <label for="image" class="block font-semibold">Gambar (Opsional)</label>
                <input type="file" name="image" class="w-full">
                @if (!empty($game['image']))
                    <p class="mt-2 text-sm">Gambar saat ini: <strong>{{ $game['image'] }}</strong></p>
                    <img src="{{ asset('images/games/' . $game['image']) }}" alt="Preview" class="w-40 h-28 object-cover mt-2 rounded">
                @endif
            </div>

            <div>
                <label for="videolink" class="block font-semibold">Link Trailer (YouTube)</label>
                <input type="text" name="videolink" value="{{ old('videolink', $game['videolink']) }}" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="mt-4 bg-[#5b63b7] text-white px-6 py-2 rounded hover:bg-[#434bac] transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-[#5b63b7] hover:underline">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection