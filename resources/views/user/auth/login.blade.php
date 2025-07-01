<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <style>
        body {
            background-color: #000;
            color: #5b63b7;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #111;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #5b63b7;
            width: 300px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #5b63b7;
            background-color: #000;
            color: #5b63b7;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5b63b7;
            border: none;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }
        a {
            color: #5b63b7;
            text-decoration: underline;
        }
        .error, .success {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login User</h2>

        {{-- Message --}}
        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @elseif (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p style="margin-top:10px;">Belum punya akun? <a href="{{ route('user.register') }}">Daftar</a></p>
    </div>
</body>
</html>
