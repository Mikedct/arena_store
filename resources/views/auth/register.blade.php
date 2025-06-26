@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h3 class="text-center mb-4">Register</h3>
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label>First Name</label>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>
                    <div class="col">
                        <label>Last Name</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Phone Number</label>
                    <input type="text" name="phoneNumber" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="dateOfBirth" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Register</button>
                <div class="text-center mt-3">
                    <a href="{{ url('/login') }}">Sudah punya akun? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
