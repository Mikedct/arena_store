<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Font modern --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #000;
            color: #4f9bd9;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #111;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px #4f9bd9;
            width: 100%;
            max-width: 420px;
            max-height: 95vh;
            overflow-y: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #4f9bd9;
            background-color: #000;
            color: #4f9bd9;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4f9bd9;
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3680bb;
        }

        a {
            color: #4f9bd9;
            text-decoration: none;
            display: block;
            margin-top: 14px;
            text-align: center;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: #ff4c4c;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .success {
            color: #9fff9f;
            font-size: 13px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register User</h2>

        {{-- Flash success --}}
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
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

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Register</button>
        </form>

        <a href="{{ route('user.login') }}">Sudah punya akun? Login</a>
    </div>
</body>
</html>
