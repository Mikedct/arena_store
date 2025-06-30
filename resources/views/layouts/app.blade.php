<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#000; color:#f9f871;">

    <nav class="navbar navbar-dark" style="background:#1c1c1c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Game Store</a>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

</body>
</html>
