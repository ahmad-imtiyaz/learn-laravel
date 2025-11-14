@extends('layouts.dashboard')

@section('title', 'Kelola Hewan')

@section('content')
<h2 class="mb-3">Kelola Data Hewan</h2>

{{-- Pesan sukses --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Form pencarian --}}
<form method="GET" action="{{ route('admin.hewan.index') }}" class="mb-3">
    <div class="input-group" style="max-width: 350px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari nama hewan...">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

<a href="{{ route('admin.hewan.create') }}" class="btn btn-success mb-3">+ Tambah Hewan</a>

<table class="table table-bordered table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datahewan as $h)
        <tr>
            <td>{{ $h->id }}</td>
            <td>
                @if($h->foto)
                    <img src="{{ asset('storage/' . $h->foto) }}" width="80" height="80" style="object-fit:cover;border-radius:8px;">
                @endif
            </td>
            <td>{{ $h->nama }}</td>
            <td>{{ $h->jenis }}</td>
            <td>
                <a href="{{ route('admin.hewan.edit', $h->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('admin.hewan.destroy', $h->id) }}" method="POST"
                      style="display:inline-block"
                      onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
{{ $datahewan->links() }}

@endsection
