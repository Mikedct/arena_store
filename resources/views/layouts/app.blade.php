<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Game Store')</title>

    <!-- Tailwind CSS (CDN, bisa ganti ke lokal jika butuh) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font & Custom Color -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-primary {
            background-color: #5b63b7;
        }

        .text-primary {
            color: #5b63b7;
        }

        .border-primary {
            border-color: #5b63b7;
        }

        .hover\:bg-primary-dark:hover {
            background-color: #434bac;
        }
    </style>
</head>
<body class="bg-gray-100 text-black min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-primary text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">🎮 GameStore</a>

            <div class="space-x-4">
                <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white text-center py-4">
        &copy; {{ date('Y') }} Game Store. All rights reserved.
    </footer>
</body>
</html>
