<!DOCTYPE html>
<html>
<head>
    <title>Daftar Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background: #333;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>

    <h1>Daftar Game</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Harga</th>
                <th>Tanggal Rilis</th>
                <th>Developer</th>
                <th>Publisher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{ $game->gameID }}</td>
                    <td>{{ $game->gameCode }}</td>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->genre }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>
                        @if($game->price == 0)
                            Free
                        @else
                            ${{ number_format($game->price, 0, ',', '.') }}
                        @endif
                    </td>
                    <td>{{ $game->releaseDate }}</td>
                    <td>{{ $game->developer }}</td>
                    <td>{{ $game->publisher }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Kembali ke <a href="{{ url('/dashboard') }}">Dashboard</a></p>

</body>
</html>
