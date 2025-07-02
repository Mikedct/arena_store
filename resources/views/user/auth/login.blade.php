<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font modern --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #5b63b7;
            color: #5b63b7;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px #5b63b7;
            width: 100%;
            max-width: 400px;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #5b63b7;
            background-color: #ffffff;
            color: #5b63b7;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5b63b7;
            border: none;
            color: #ffffff;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3680bb;
        }

        a {
            color: #5b63b7;
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
    <div class="login-container">
        <h2>Login User</h2>

        {{-- Flash success --}}
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        {{-- Error dari validasi --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form method="POST" action="{{ route('user.login.submit') }}">
            @csrf

            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>

        <a href="{{ route('user.register') }}">Belum punya akun? Daftar sekarang</a>
    </div>
</body>
</html>
