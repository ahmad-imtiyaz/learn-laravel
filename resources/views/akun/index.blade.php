@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="container">
    <h2>👤 Akun Saya</h2>
    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Role:</strong> {{ Auth::user()->role }}</p>

    <hr>
    <h4>Ubah Password</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('akun.updatePassword') }}" method="POST" style="max-width:400px;">
        @csrf
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required minlength="5">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required minlength="5">
        </div>
        <button class="btn btn-primary">Simpan Password</button>
    </form>
</div>
@endsection
