@extends('layouts.dashboard')

@section('title', 'Daftar Hewan')

@section('content')
<h2 class="mb-3">Daftar Hewan</h2>

{{-- Form pencarian --}}
<form method="GET" action="{{ route('hewan.index') }}" class="mb-3">
    <div class="input-group" style="max-width: 350px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari hewan...">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datahewan as $h)
        <tr>
            <td>
                @if($h->foto)
                    <img src="{{ asset('storage/' . $h->foto) }}" width="80" height="80" style="object-fit:cover;border-radius:8px;">
                @endif
            </td>
            <td>{{ $h->nama }}</td>
            <td>{{ $h->jenis }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $datahewan->links() }}

@endsection
