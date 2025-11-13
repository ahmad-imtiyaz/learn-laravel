@extends('layouts.app')

@section('title', 'Daftar Hewan')

@section('content')
<h2>🐾 Daftar Hewan</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(Auth::user()->role === 'admin')
    <a href="{{ route('hewan.create') }}" class="btn btn-primary mb-3">+ Tambah Hewan Baru</a>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama Hewan</th>
            <th>Jenis</th>
            @if(Auth::user()->role === 'admin')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($dataHewan as $DH)
        <tr>
            <td>{{ $DH->id }}</td>
            <td>
                @if ($DH->foto)
                    <img src="{{ asset('storage/' . $DH->foto) }}" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
                @endif
            </td>
            <td>{{ $DH->nama }}</td>
            <td>{{ $DH->jenis }}</td>
            @if(Auth::user()->role === 'admin')
            <td>
                <a href="{{ route('hewan.edit', $DH->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('hewan.destroy', $DH->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

{{ $dataHewan->links() }}
@endsection
