<!DOCTYPE html>
<html>
<head>
    <title>Admin - Daftar Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px 14px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #5b63b7;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-paid {
            color: green;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pembayaran</h2>

        @if (count($payments) > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Game</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->user->username ?? 'Unknown User' }}</td>
                            <td>{{ $p->game->title ?? 'Unknown Game' }}</td>
                            <td>{{ $p->paymentMethod }}</td>
                            <td>
                                @if ($p->paymentStatus === 'paid')
                                    <span class="status-paid">Lunas</span>
                                @else
                                    <span class="status-pending">Pending</span>
                                @endif
                            </td>
                            <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data pembayaran.</p>
        @endif

        <a class="back" href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard Admin</a>
    </div>
</body>
</html>
