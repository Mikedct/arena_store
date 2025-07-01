<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7fafc;
            color: #2d3748;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #2d3748;
            color: white;
        }

        tr:hover {
            background-color: #edf2f7;
        }

        .action a {
            color: #3182ce;
            text-decoration: none;
        }

        .action a:hover {
            text-decoration: underline;
        }

        .empty-message {
            text-align: center;
            color: red;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <h1>👥 Daftar Pengguna</h1>

    @if (!empty($users))
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telepon</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['userID'] }}</td>
                        <td>{{ $user['firstName'] }} {{ $user['lastName'] }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($user['dateOfBirth'])->format('d M Y') }}</td>
                        <td>{{ $user['phoneNumber'] }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user['userID']) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: red; color: white; border: none; padding: 5px 10px; border-radius: 5px;">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="empty-message">Tidak ada data pengguna ditemukan.</p>
    @endif

</body>

</html>