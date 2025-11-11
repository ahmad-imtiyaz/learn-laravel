<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Hewan</title>
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Tambah Hewan</h2>

    <!-- ✅ Tambahkan enctype agar file bisa dikirim -->
    <form action="{{ route('hewan.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
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

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Hewan</label>
           <!-- input file: tambahkan onchange dan accept -->
<input type="file"
       name="foto"
       id="foto"
       accept="image/*"
       class="form-control @error('foto') is-invalid @enderror"
       onchange="previewImage(event)">

@error('foto')
    <small class="text-danger">{{ $message }}</small>
@enderror

<!-- Preview Gambar -->
<div class="mt-3" id="preview-container" style="display:none;">
    <p>Preview Gambar:</p>
    <img id="preview" src="#" alt="Preview Foto" width="100" height="100"
         style="object-fit:cover; border-radius:8px;">
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return; // tidak ada file, keluar

    // optional: cek tipe file
    if (!file.type.startsWith('image/')) {
        alert('Tolong pilih file gambar.');
        return;
    }

    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('preview');
        output.src = reader.result;
        document.getElementById('preview-container').style.display = 'block';
    };
    reader.readAsDataURL(file);
}
</script>
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
