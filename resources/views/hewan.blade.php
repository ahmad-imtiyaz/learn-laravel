<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">Daftar Hewan</h1>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="mb-3 text-end">
        <a href="{{ route('hewan.create') }}" class="btn btn-success">+ Tambah Hewan</a>
    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if($datahewan->isEmpty())
            <tr>
                <td colspan="4">Belum ada data hewan.</td>
            </tr>
        @else
            @foreach ($datahewan as $dh)
            <tr>
                <td>{{ $dh->id }}</td>
                <td>{{ $dh->nama }}</td>
                <td>{{ $dh->jenis }}</td>
                <td>
                    <a href="{{ route('hewan.edit', $dh->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('hewan.destroy', $dh->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
