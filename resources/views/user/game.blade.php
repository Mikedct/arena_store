<!DOCTYPE html>
<html>
<head>
    <title>Detail Game</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .game-img {
            display: block;
            margin: 0 auto 20px;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.2);
        }

        .info {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2d3748;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>{{ $game['title'] }}</h1>

        @if (!empty($game['image']))
            <img src="{{ asset('images/games/' . $game['image']) }}" class="game-img" alt="{{ $game['title'] }}">
        @else
            <img src="{{ asset('images/games/default.png') }}" class="game-img" alt="Default Image">
        @endif

        <div class="info"><span class="label">Kode Game:</span> {{ $game['gameCode'] }}</div>
        <div class="info"><span class="label">Genre:</span> {{ $game['genre'] }}</div>
        <div class="info"><span class="label">Platform:</span> {{ $game['platform'] }}</div>
        <div class="info"><span class="label">Harga:</span> ${{ $game['price'] }}</div>
        <div class="info"><span class="label">Rilis:</span> {{ $game['releaseDate'] }}</div>
        <div class="info"><span class="label">Developer:</span> {{ $game['developer'] }}</div>
        <div class="info"><span class="label">Publisher:</span> {{ $game['publisher'] }}</div>
        <div class="info"><span class="label">Deskripsi:</span><br> {{ $game['description'] }}</div>

        <a href="{{ url('/user/dashboard') }}" class="back-link">← Kembali ke Daftar Game</a>
    </div>

</body>
</html>