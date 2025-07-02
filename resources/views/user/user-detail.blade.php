<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            color: #2d3748;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #4a5568;
        }

        .info span {
            display: block;
            margin-top: 4px;
            font-size: 16px;
        }

        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4299e1;
            color: white;
            padding: 10px 16px;
            border-radius: 5px;
        }

        a.back:hover {
            background-color: #3182ce;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>🧑 Detail Pengguna</h1>

        <div class="info">
            <label>Nama Lengkap:</label>
            <span>{{ $user['firstName'] }} {{ $user['lastName'] }}</span>

            <label>Username:</label>
            <span>{{ $user['username'] }}</span>

            <label>Email:</label>
            <span>{{ $user['email'] }}</span>

            <label>Tanggal Lahir:</label>
            <span>{{ \Carbon\Carbon::parse($user['dateOfBirth'])->format('d F Y') }}</span>

            <label>Nomor Telepon:</label>
            <span>{{ $user['phoneNumber'] }}</span>
        </div>

        <a class="back" href="{{ url('/user/dashboard') }}">⬅ Kembali ke Dashboard</a>
    </div>

</body>
</html>