@extends('layouts.admin')

@section('title', 'Tambah Game')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-lg shadow-md mt-10">
    <h1 class="text-2xl font-bold text-center text-[#5b63b7] mb-6">🎮 Tambah Game Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.game.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="adminID" value="{{ session('adminID') }}">

        <div class="grid grid-cols-1 gap-4">
            <label class="block font-semibold">Kode Game
                <input type="text" name="gameCode" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Judul
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Genre
                <input type="text" name="genre" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Platform
                <input type="text" name="platform" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Harga
                <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Tanggal Rilis
                <input type="date" name="releaseDate" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Developer
                <input type="text" name="developer" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Publisher
                <input type="text" name="publisher" class="w-full border rounded px-3 py-2" required>
            </label>

            <label class="block font-semibold">Deskripsi
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
            </label>

            <label class="block font-semibold">Gambar (Opsional)
                <input type="file" name="image" class="w-full">
            </label>

            <label class="block font-semibold">Link Trailer (YouTube)
                <input type="text" name="videolink" class="w-full border rounded px-3 py-2">
            </label>

            <button type="submit" class="mt-4 bg-[#5b63b7] text-white px-6 py-2 rounded hover:bg-[#434bac] transition">
                ➕ Tambah Game
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-[#5b63b7] hover:underline">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection
