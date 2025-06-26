<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game Store Dashboard</title>
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

        .add-button {
            display: block;
            width: fit-content;
            margin: 0 auto 20px;
            padding: 10px 20px;
            background-color: var(--accent);
            color: var(--white);
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #3182ce;
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

        .actions {
            margin-top: 15px;
        }

        .actions a,
        .actions button {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 14px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .edit-btn {
            background-color: #48bb78;
            color: white;
        }

        .delete-btn {
            background-color: #e53e3e;
            color: white;
        }

        .edit-btn:hover {
            background-color: #38a169;
        }

        .delete-btn:hover {
            background-color: #c53030;
        }

        .empty-message {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>

    <h1>🎮 Game Store Dashboard</h1>

    <a class="add-button" href="{{ url('/game/create') }}">➕ Tambah Game Baru</a>

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
                                style="max-width: 100%; height: auto; border-radius: 8px;">
                        </div>
                    @endif
                    <h2>{{ $game['title'] }} ({{ $game['gameCode'] }})</h2>
                    <div class="game-info">
                        <p><span class="label">Genre:</span> {{ $game['genre'] }}</p>
                        <p><span class="label">Platform:</span> {{ $game['platform'] }}</p>
                        <p><span class="label">Price:</span> ${{ $game['price'] }}</p>
                        <p><span class="label">Release Date:</span> {{ $game['releaseDate'] }}</p>
                        <p><span class="label">Developer:</span> {{ $game['developer'] }}</p>
                        <p><span class="label">Publisher:</span> {{ $game['publisher'] }}</p>
                        <p><span class="label">Description:</span> {{ Str::limit($game['description'], 120) }}</p>
                    </div>

                    <div class="actions">
                        <a class="edit-btn" href="{{ route('game.edit', $game['gameID']) }}">✏️ Edit</a>
                        <form action="{{ route('game.destroy', $game['gameID']) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus game ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn" type="submit">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</body>

</html>

@php
    function is_assoc(array $arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp