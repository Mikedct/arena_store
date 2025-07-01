<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <style>
        body {
            background-color: #000000;
            color: #5b63b7;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #111;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #5b63b7;
            width: 350px;
            max-height: 95vh;
            overflow-y: auto;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 12px;
            border: 1px solid #5b63b7;
            background-color: #000;
            color: #5b63b7;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5b63b7;
            border: none;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        a {
            color: #5b63b7;
            text-decoration: underline;
            display: inline-block;
            margin-top: 12px;
            text-align: center;
            width: 100%;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="text-xl mb-4">Register User</h2>

        {{-- Flash success --}}
        @if (session('success'))
            <p class="text-green-400 mb-2">{{ session('success') }}</p>
        @endif

        {{-- Error dari validasi --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="{{ route('user.register.submit') }}">
            @csrf

            <label>First Name</label>
            <input type="text" name="firstName" value="{{ old('firstName') }}" required>

            <label>Last Name</label>
            <input type="text" name="lastName" value="{{ old('lastName') }}" required>

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Date of Birth</label>
            <input type="date" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required>

            <label>Phone Number</label>
            <input type="text" name="phoneNumber" value="{{ old('phoneNumber') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

        <a href="{{ route('user.login') }}">Sudah punya akun? Login</a>
    </div>
</body>
</html>
