<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
</head>
<body>
    <h2>Register Admin</h2>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <label>First Name:</label><br>
        <input type="text" name="firstName" value="{{ old('firstName') }}"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastName" value="{{ old('lastName') }}"><br><br>

        <label>Username:</label><br>
        <input type="text" name="username" value="{{ old('username') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dateOfBirth" value="{{ old('dateOfBirth') }}"><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phoneNumber" value="{{ old('phoneNumber') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
</body>
</html>
