<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h2>Login Admin</h2>

    @if ($errors->has('login'))
        <p style="color:red;">{{ $errors->first('login') }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ url('/register') }}">Register</a><p>
    
</body>
</html>
