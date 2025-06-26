<!DOCTYPE html>
<html>
<head>
    <title>Game Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f7f7f7;
        }
        h1 {
            text-align: center;
        }
        .game {
            background: #fff;
            padding: 20px;
            margin: 15px auto;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            width: 80%;
        }
        .game h2 {
            margin-top: 0;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Game Store Dashboard</h1>

    @if (empty($games))
        <p style="text-align: center; color: red;">Tidak ada data ditemukan.</p>
    @else
        @php
            $games = is_assoc($games) ? [$games] : $games;
        @endphp

        @foreach ($games as $game)
            <div class="game">
                <h2>{{ $game['title'] }} ({{ $game['gameCode'] }})</h2>
                <p><span class="label">Genre:</span> {{ $game['genre'] }}</p>
                <p><span class="label">Platform:</span> {{ $game['platform'] }}</p>
                <p><span class="label">Price:</span> ${{ $game['price'] }}</p>
                <p><span class="label">Release Date:</span> {{ $game['releaseDate'] }}</p>
                <p><span class="label">Developer:</span> {{ $game['developer'] }}</p>
                <p><span class="label">Publisher:</span> {{ $game['publisher'] }}</p>
                <p><span class="label">Description:</span> {{ $game['description'] }}</p>
            </div>
        @endforeach
    @endif

</body>
</html>

{{-- Helper: check if array is associative --}}
@php
    function is_assoc(array $arr) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
@endphp
