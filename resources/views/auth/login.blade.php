@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card p-4">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
                    <a href="{{ url('/register') }}">Belum punya akun? Daftar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
