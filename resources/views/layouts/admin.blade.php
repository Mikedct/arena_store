<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2d3748;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h3 {
            margin: 0;
        }

        .logout-btn {
            background-color: #e53e3e;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        
        .users-btn {
            background-color: #e53e3e;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        main {
            padding: 30px;
        }
    </style>
</head>
<body>

    <header>
        <div>
            <h3>👋 Halo, {{ session('admin')['firstName'] ?? 'Pengguna' }} {{ session('admin')['lastName'] ?? '' }}</h3>
        </div>
        <div>
            <a href="{{ route('admin.users') }}" class="users-btn">List User</a>
            <a href="{{ route('admin.logout') }}" class="logout-btn">Logout</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
