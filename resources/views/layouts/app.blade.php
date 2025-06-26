<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Game Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
        }

        .navbar, .btn-primary {
            background-color: #5b63b7 !important;
            border-color: #5b63b7 !important;
        }

        .btn-primary:hover {
            background-color: #4a52a0 !important;
        }

        .card {
            background-color: #1a1a1a;
            border: 1px solid #5b63b7;
        }

        a {
            color: #5b63b7;
        }

        a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4">
        <span class="navbar-brand">Game Store</span>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
