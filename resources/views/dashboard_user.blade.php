<!DOCTYPE html>
@extends('layouts.user')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Store - Dashboard User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #2d3748;
            --secondary: #4a5568;
            --accent: #4299e1;
            --bg: #f7fafc;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: var(--primary);
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form.search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px 12px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 8px 14px;
            background-color: var(--accent);
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .game-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.2s ease;
        }

        .game-card:hover {
            transform: translateY(-3px);
        }

        .game-card h2 {
            color: var(--accent);
            margin-bottom: 10px;
        }

        .game-info p {
            margin: 6px 0;
        }

        .label {
            font-weight: bold;
        }

        .empty-message {
            text-align: center;
            color: red;
        }

        a.title-link {
            text-decoration: none;
            color: var(--accent);
        }

        a.title-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h1>🎮 Game Store - Dashboard Pengguna</h1>

    <form class="search-form" method="GET" action="{{ url('/user/dashboard') }}">
        <input type="text" name="search" placeholder="Cari berdasarkan judul, genre, platform..."
            value="{{ request('search') }}">
        <button type="submit">🔍 Cari</button>
    </form>

    @if (empty($games))
        <p class="empty-message">Tidak ada data ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        <div class="grid">
            @foreach ($games as $game)
                <div class="game-card">
                    @if (!empty($game['image']))
                        <div style="text-align: center;">
                            <img src="{{ asset('images/games/' . $game['image']) }}" alt="{{ $game['title'] }}"
                                style="width: 300px; height: 400px; object-fit: cover; border-radius: 8px;">
                        </div>
                    @endif

                    <h2>
                        <a class="title-link" href="{{ url('/user/game-detail/' . $game['gameID']) }}">
                            {{ $game['title'] }} ({{ $game['gameCode'] }})
                        </a>
                    </h2>
                    <div class="game-info">
                        <p><span class="label">Genre:</span> {{ $game['genre'] }}</p>
                        <p><span class="label">Platform:</span> {{ $game['platform'] }}</p>
                        <p><span class="label">Price:</span> ${{ $game['price'] }}</p>
                        <p><span class="label">Release Date:</span> {{ $game['releaseDate'] }}</p>
                        <p><span class="label">Developer:</span> {{ $game['developer'] }}</p>
                        <p><span class="label">Publisher:</span> {{ $game['publisher'] }}</p>
                        <p><span class="label">Description:</span> {{ Str::limit($game['description'], 120) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</body>
@endsection

</html>

@php
    function is_assoc(array $arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp