<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
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
            background: #e0e0e0;
            padding: 10px 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2></h2>History Payments</h2>

        @if(count($payments) > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Game</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->game->title ?? 'Tidak ditemukan' }}</td>
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
            <p>Tidak ada pembayaran yang ditemukan.</p>
        @endif

        <a href="{{ route('user.dashboard') }}" class="back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
