{{-- resources/views/hewan/table.blade.php --}}
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

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $datahewan->links() !!}
</div>
