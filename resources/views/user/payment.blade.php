<!DOCTYPE html>
<html>
<head>
    <title>{{ $game->title }} - Detail Game</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        iframe {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
        }
        .info p {
            margin: 8px 0;
        }
        .game-img {
            display: block;
            margin: 0 auto 20px;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.2);
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            background: #e0e0e0;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $game->title }} ({{ $game->gameCode }})</h2>

        @if (!empty($game->image))
            <img src="{{ asset('images/games/' . $game->image) }}" class="game-img" alt="{{ $game->title }}">
        @else
            <img src="{{ asset('images/games/default.png') }}" class="game-img" alt="Default Image">
        @endif

        <div class="info">
            <p><strong>Genre:</strong> {{ $game->genre }}</p>
            <p><strong>Platform:</strong> {{ $game->platform }}</p>
            <p><strong>Price:</strong> ${{ $game->price }}</p>
            <p><strong>Release Date:</strong> {{ $game->releaseDate }}</p>
            <p><strong>Developer:</strong> {{ $game->developer }}</p>
            <p><strong>Publisher:</strong> {{ $game->publisher }}</p>
            <p><strong>Description:</strong> {{ $game->description }}</p>
        </div>

        @if (!empty($game->videolink))
            <h3>🎬 Trailer</h3>
            <iframe src="{{ $game->videolink }}" allowfullscreen></iframe>
        @endif

        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="game_id" value="{{ $game->id }}">

            <label for="paymentMethod">Metode Pembayaran:</label>
            <select name="paymentMethod" id="paymentMethod" required>
                <option value="Gopay">Gopay</option>
                <option value="Visa">Visa</option>
                <option value="OVO">OVO</option>
            </select>

            <button type="submit">Bayar Sekarang</button>
        </form>

        <a class="back" href="{{ url('/user/dashboard') }}">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
