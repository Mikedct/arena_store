@extends('layouts.app')

@section('title', 'Edit Review - Admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-[#5b63b7] mb-6">✏️ Edit Review</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.review.update', $review['reviewID']) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-2">Username</label>
            <input type="text" name="username" value="{{ $review['username'] }}" class="w-full border rounded px-4 py-2 bg-gray-100" readonly>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Judul Game</label>
            <input type="text" name="title" value="{{ $review['title'] }}" class="w-full border rounded px-4 py-2 bg-gray-100" readonly>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Rating (1-5)</label>
            <input type="number" name="Rating" value="{{ $review['Rating'] }}" min="1" max="5" required class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Komentar</label>
            <textarea name="Text" rows="4" class="w-full border rounded px-4 py-2" required>{{ $review['Text'] }}</textarea>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
