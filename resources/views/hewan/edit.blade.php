<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Hewan</title>
    <!-- Link Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Data Hewan</h4>
            </div>
            <div class="card-body">
<form action="{{ route('hewan.update', $hewan->id) }}" method="POST" enctype="multipart/form-data">
         @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Hewan</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="{{ old('nama', $hewan->nama) }}" required>
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Hewan</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" 
                               value="{{ old('jenis', $hewan->jenis) }}" required>
                        @error('jenis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                      <div class="mb-3">
    <label for="foto" class="form-label">Foto Hewan (opsional)</label>
    <input type="file" name="foto" id="foto" 
           class="form-control @error('foto') is-invalid @enderror"
           accept="image/*" onchange="previewNewImage(event)">
    @error('foto')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div class="row mt-3">
        @if($hewan->foto)
        <div class="col-md-6 text-center">
            <p><strong>Foto Saat Ini:</strong></p>
            <img src="{{ asset('storage/' . $hewan->foto) }}" 
                 alt="Foto Lama" width="120" height="120"
                 style="object-fit:cover; border-radius:8px;">
        </div>
        @endif

        <div class="col-md-6 text-center" id="preview-container" style="display:none;">
            <p><strong>Foto Baru Dipilih:</strong></p>
            <img id="preview" src="#" alt="Preview Foto Baru" 
                 width="120" height="120" 
                 style="object-fit:cover; border-radius:8px;">
        </div>
    </div>
</div>

<script>
function previewNewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        document.getElementById('preview-container').style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>


                    <div class="d-flex justify-content-between">
                        <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
