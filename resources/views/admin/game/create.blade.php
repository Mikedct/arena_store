<!DOCTYPE html>
<html>
<head>
    <title>Tambah Game Baru</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }
        form {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #2d3748;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Tambah Game Baru</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('game.store') }}" enctype="multipart/form-data">
        @csrf
        
        <label>Kode Game</label>
        <input type="text" name="gameCode" required>

        <label>Judul</label>
        <input type="text" name="title" required>

        <label>Genre</label>
        <input type="text" name="genre" required>

        <label>Platform</label>
        <input type="text" name="platform" required>

        <label>Harga</label>
        <input type="number" name="price" required>

        <label>Tanggal Rilis</label>
        <input type="date" name="releaseDate" required>

        <label>Developer</label>
        <input type="text" name="developer" required>

        <label>Publisher</label>
        <input type="text" name="publisher" required>

        <label>Deskripsi</label>
        <textarea name="description" rows="5" required></textarea>

        <label for="image">Gambar</label>
        <input type="file" name="image" accept="image/*">

        <label>Link Video</label>
        <input type="text" name="videolink">

        <label>Admin ID</label>
        <input type="number" name="adminID" required>

        <button type="submit">Simpan</button>
    </form>

</body>
</html>