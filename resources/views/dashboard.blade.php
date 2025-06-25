<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat Datang, {{ session('admin')->firstName }}</h2>
    <p><a href="{{ url('/game-view') }}">Game View</a></p>
    <p><a href="{{ url('/logout') }}">Logout</a></p>
</body>
</html>
