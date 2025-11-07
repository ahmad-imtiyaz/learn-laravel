<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Hewan</title>
</head>
<body style="font-family: Arial; margin: 40px;">
    <h1>Daftar Hewan</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis</th>
        </tr>

        @foreach ($datahewan as $dh)
        <tr>
            <td>{{ $dh->id }}</td>
            <td>{{ $dh->nama }}</td>
            <td>{{ $dh->jenis }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>