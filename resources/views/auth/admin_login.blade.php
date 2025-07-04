<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
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
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>

        @if ($errors->has('message'))
            <div class="error">{{ $errors->first('message') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
