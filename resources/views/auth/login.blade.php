<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            background-color: #000000;
            color: #f9f871;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #111111;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px #f9f871;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #f9f871;
            border-radius: 5px;
            background-color: #000;
            color: #f9f871;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #f9f871;
            color: #000000;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #eae95f;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #f9f871;
            text-decoration: underline;
        }

        .register-link a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin</h2>

        @if ($errors->has('login'))
            <p class="error">{{ $errors->first('login') }}</p>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
