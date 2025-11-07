<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hewan</title>
</head>
<body style="font-family: Arial; margin: 40px;">

    <h1>Daftar Hewan</h1>

    {{-- Tombol Tambah --}}
    <a href="{{ route('hewan.create') }}" 
       style="display: inline-block; margin-bottom: 20px; background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
       + Tambah Hewan
    </a>

    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 70%;">
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>

        @if($datahewan->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada data hewan.</td>
            </tr>
        @else
            @foreach ($datahewan as $dh)
            <tr>
                <td>{{ $dh->id }}</td>
                <td>{{ $dh->nama }}</td>
                <td>{{ $dh->jenis }}</td>
                <td>
                    <a href="{{ route('hewan.edit', $dh->id) }}" 
                       style="background-color: #ffc107; color: black; padding: 5px 10px; text-decoration: none; border-radius: 4px;">
                       Edit
                    </a>
                    
                    <form action="{{ route('hewan.destroy', $dh->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </table>

</body>
</html>
