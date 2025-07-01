@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold text-center mb-6 text-[#5b63b7]">✏️ Edit Game</h1>

    <form action="{{ url('/admin/game/edit/' . $game['gameID']) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Judul Game</label>
            <input type="text" name="title" value="{{ $game['title'] }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Genre</label>
            <input type="text" name="genre" value="{{ $game['genre'] }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Platform</label>
            <input type="text" name="platform" value="{{ $game['platform'] }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Harga</label>
            <input type="number" step="0.01" name="price" value="{{ $game['price'] }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Tanggal Rilis</label>
            <input type="date" name="releaseDate" value="{{ $game['releaseDate'] }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Developer</label>
            <input type="text" name="developer" value="{{ $game['developer'] }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Publisher</label>
            <input type="text" name="publisher" value="{{ $game['publisher'] }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2">{{ $game['description'] }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Video Trailer (Link)</label>
            <input type="url" name="videolink" value="{{ $game['videolink'] }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Gambar Game</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-[#5b63b7] text-white px-4 py-2 rounded hover:bg-[#434bac]">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
