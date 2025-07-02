@extends('layouts.app')

@section('title', 'Edit Akun')

@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold text-center mb-6">✏️ Edit Profil</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.update', ['id' => $user['userID']]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Nama Depan</label>
                <input type="text" name="firstName" value="{{ old('firstName', $user['firstName']) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Nama Belakang</label>
                <input type="text" name="lastName" value="{{ old('lastName', $user['lastName']) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Username</label>
                <input type="text" name="username" value="{{ old('username', $user['username']) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user['email']) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Nomor Telepon</label>
                <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $user['phoneNumber']) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-6">
                <label class="block font-medium">Tanggal Lahir</label>
                <input type="date" name="dateOfBirth" value="{{ old('dateOfBirth', $user['dateOfBirth']) }}" class="w-full border rounded p-2">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('user.show', ['id' => $user['userID']]) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
