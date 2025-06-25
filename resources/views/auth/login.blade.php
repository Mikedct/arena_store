<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color: #000000;
            color: #f9f871;
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
            box-shadow: 0 0 10px #f9f871;
            width: 300px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f9f871;
            background-color: #000;
            color: #f9f871;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #f9f871;
            border: none;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }
        a {
            color: #f9f871;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>

        @if ($errors->has('login'))
            <p style="color: red;">{{ $errors->first('login') }}</p>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Belum punya akun? <a href="{{ url('/register') }}">Register</a></p>
    </div>
</body>
</html>
