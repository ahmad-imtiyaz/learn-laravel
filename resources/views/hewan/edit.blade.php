<!DOCTYPE html>
<html>
<head>
    <title>Edit Hewan</title>
</head>
<body style="font-family: Arial; margin: 40px;">
    <h1>Edit Data Hewan</h1>

    <form action="{{ route('hewan.update', $hewan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Hewan:</label><br>
        <input type="text" name="nama" value="{{ $hewan->nama }}"><br><br>

        <label>Jenis Hewan:</label><br>
        <input type="text" name="jenis" value="{{ $hewan->jenis }}"><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('hewan.index') }}">Kembali ke daftar</a>
</body>
</html>
