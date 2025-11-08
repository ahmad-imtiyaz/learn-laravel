<!DOCTYPE html>
<html>
<head>
    <title>Daftar Hewan</title>
</head>
<body style="font-family: Arial; margin: 40px;">
    <h1>Daftar Hewan</h1>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif


    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('hewan.create') }}">+ Tambah Hewan Baru</a>

    <table border="1" cellpadding="10" style="margin-top: 10px;">
        <tr>
            <th>ID</th>
            <th>Nama Hewan</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
        @foreach ($dataHewan as $DH)
        <tr>
            <td>{{ $DH->id }}</td>
            <td>{{ $DH->nama }}</td>
            <td>{{ $DH->jenis }}</td>
            <td>
                <a href="{{ route('hewan.edit', $DH->id) }}">Edit</a> |
                <a href="{{ route('hewan.destroy', $DH->id) }}" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
