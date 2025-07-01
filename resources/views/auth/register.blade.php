<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Akun</title>
    <style>
        body {
            background-color: #000;
            color: #5b63b7;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #111;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #5b63b7;
            width: 400px;
        }
        input {
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
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: lightgreen;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun Baru</h2>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="dateOfBirth" placeholder="Date of Birth" required>
            <input type="text" name="phoneNumber" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="{{ route('login.form') }}">Login di sini</a></p>
    </div>
</body>
</html>
