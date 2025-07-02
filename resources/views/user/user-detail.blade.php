@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Detail Pengguna</h1>

        <div class="space-y-4">
            <div>
                <label class="font-semibold text-gray-600">Nama Lengkap:</label>
                <div>{{ $user['firstName'] }} {{ $user['lastName'] }}</div>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Username:</label>
                <div>{{ $user['username'] }}</div>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Email:</label>
                <div>{{ $user['email'] }}</div>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Tanggal Lahir:</label>
                <div>{{ \Carbon\Carbon::parse($user['dateOfBirth'])->format('d F Y') }}</div>
            </div>

            <div>
                <label class="font-semibold text-gray-600">Nomor Telepon:</label>
                <div>{{ $user['phoneNumber'] }}</div>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ url('/user/dashboard') }}"
               class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                ⬅ Kembali
            </a>

            <a href="{{ route('user.edit', ['id' => $user['userID']]) }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                ✏️ Edit Profil
            </a>
        </div>
    </div>
@endsection
