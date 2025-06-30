<!DOCTYPE html>
<html>
<head>
    <title>Game Store - User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 40px;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto 30px;
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            background: #2d3748;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .game-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .game-card img {
            width: 120px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }

        .game-info {
            flex: 1;
        }

        .game-info h2 {
            margin: 0 0 10px;
            color: #2d3748;
        }

        .game-info p {
            margin: 5px 0;
        }

        .label {
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

    <h1>Game Store - Daftar Game</h1>

    <form method="GET" action="{{ url('/user/dashboard') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, genre, atau platform...">
        <button type="submit">Cari</button>
    </form>

    @if (empty($games))
        <p class="no-data">Tidak ada data game ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        @foreach ($games as $game)
            <div class="game-card">
                @if (!empty($game['image']))
                    <img src="{{ asset('images/games/' . $game['image']) }}" alt="{{ $game['title'] }}">
                @else
                    <img src="{{ asset('images/games/default.png') }}" alt="Default Image">
                @endif

                <div class="game-info">
                    <h2>{{ $game['title'] }} ({{ $game['gameCode'] }})</h2>
                    <p><span class="label">Genre:</span> {{ $game['genre'] }}</p>
                    <p><span class="label">Platform:</span> {{ $game['platform'] }}</p>
                    <p><span class="label">Harga:</span> ${{ $game['price'] }}</p>
                    <p><span class="label">Rilis:</span> {{ $game['releaseDate'] }}</p>
                    <p><span class="label">Developer:</span> {{ $game['developer'] }}</p>
                    <p><span class="label">Publisher:</span> {{ $game['publisher'] }}</p>
                    <p><span class="label">Deskripsi:</span> {{ $game['description'] }}</p>
                </div>
            </div>
        @endforeach
    @endif

</body>
</html>

{{-- Helper --}}
@php
function is_assoc(array $arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}
@endphp
