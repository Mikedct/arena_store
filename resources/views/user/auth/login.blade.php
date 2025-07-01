@extends('layouts.app')

@section('title', 'Login User - Game Store')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-[#5b63b7] mb-6">Login Akun</h2>

        {{-- Alert Success --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        {{-- Alert Error --}}
        @if($errors->any())
            <x-alert type="error" :message="$errors->first()" />
        @endif

        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                       class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5b63b7]">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                       class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5b63b7]">
            </div>

            <button type="submit"
                class="w-full bg-[#5b63b7] hover:bg-[#434a98] text-white font-bold py-2 px-4 rounded transition">
                Login
            </button>

            <div class="mt-4 text-center text-sm">
                Belum punya akun?
                <a href="{{ route('user.register') }}" class="text-[#5b63b7] hover:underline">Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>
@endsection
