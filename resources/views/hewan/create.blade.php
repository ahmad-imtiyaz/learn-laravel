<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Hewan</title>
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Tambah Hewan</h2>

    <form action="{{ route('hewan.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
    <label for="nama" class="form-label">Nama Hewan</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
    @error('nama')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

        <div class="mb-3">
            <label class="form-label">Jenis Hewan</label>
            <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Perhatikan kesalahan berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
</body>

</html>
