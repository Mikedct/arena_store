<!DOCTYPE html>
<html>
<head>
    <title>Edit Game</title>
    <style>
        body { font-family: sans-serif; background-color: #f5f5f5; padding: 40px; }
        form { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: #2d3748; color: white; border: none; border-radius: 5px; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Edit Game: {{ $game['title'] }}</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('game.update', $game['gameID']) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <label>Kode Game</label>
        <input type="text" name="gameCode" value="{{ $game['gameCode'] }}" required>

        <label>Judul</label>
        <input type="text" name="title" value="{{ $game['title'] }}" required>

        <label>Genre</label>
        <input type="text" name="genre" value="{{ $game['genre'] }}" required>

        <label>Platform</label>
        <input type="text" name="platform" value="{{ $game['platform'] }}" required>

        <label>Harga</label>
        <input type="number" name="price" value="{{ $game['price'] }}" required>

        <label>Tanggal Rilis</label>
        <input type="date" name="releaseDate" value="{{ $game['releaseDate'] }}" required>

        <label>Developer</label>
        <input type="text" name="developer" value="{{ $game['developer'] }}" required>

        <label>Publisher</label>
        <input type="text" name="publisher" value="{{ $game['publisher'] }}" required>

        <label>Deskripsi</label>
        <textarea name="description" rows="5" required>{{ $game['description'] }}</textarea>

        <label for="image">Gambar</label>
        <input type="file" name="image" accept="image/*">

        <label>Link Video</label>
        <input type="text" name="videolink" value="{{ $game['videolink'] }}" required>

        <label>Admin ID</label>
        <input type="number" name="adminID" value="{{ $game['adminID'] }}" required>

        <button type="submit">Perbarui</button>
    </form>

</body>
</html>
