<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Game Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Navbar Admin --}}
    @include('layouts.partials.admin-navbar')

    {{-- Content --}}
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
