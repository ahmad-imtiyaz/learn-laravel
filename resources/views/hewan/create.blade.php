<!DOCTYPE html>
<html>
<head>
    <title>Tambah Hewan</title>
</head>
<body style="font-family: Arial; margin: 40px;">
    <h1>Tambah Hewan Baru</h1>

    <form action="{{ route('hewan.store') }}" method="POST">
        @csrf
        <label>Nama Hewan:</label><br>
        <input type="text" name="nama"><br><br>

        <label>Jenis Hewan:</label><br>
        <input type="text" name="jenis"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('hewan.index') }}">Kembali ke daftar</a>
</body>
</html>
