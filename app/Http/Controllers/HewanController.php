<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;

class HewanController extends Controller
{
    public function index() // Controller untuk menampilkan daftar hewan
    {
        $datahewan = Hewan::all();
        return view('hewan', compact('datahewan'));
    }

    public function create() // Controller untuk menampilkan form tambah data hewan
    {
        return view('hewan.create');
    }

    public function store(Request $request) // Controller untuk menyimpan data hewan
    {
        // VALIDAASI DATA MASUK
        $validated = $request->validate([
            'nama' => 'required|min:3|unique:hewans,nama',
            'jenis' => 'required|min:3',
        ], [
            'nama.required' => 'Nama hewan wajib diisi.',
            'nama.min' => 'Nama hewan minimal 3 huruf!',
            'nama.unique' => 'Nama hewan sudah ada!',
            'jenis.required' => 'Jenis hewan wajib diisi.',
            'jenis.min' => 'Jenis hewan minimal 3 huruf!',
        ]);

        // SIMPAN KE DATABASE
        \App\Models\Hewan::create($validated);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function edit($id) // Controller untuk menampilkan form edit data hewan
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.edit', compact('hewan'));
    }

    public function update(Request $request, $id) // Controller untuk mengupdate data hewan
    {
        $hewan = \App\Models\Hewan::findOrFail($id);

        // VALIDASI UPDATE (ABAIKAN DATA SENDIRI PADA UNIQUE)
        $validated = $request->validate([
            'nama' => 'required|min:3|unique:hewans,nama,' . $id,
            'jenis' => 'required|min:3',
        ], [
            'nama.required' => 'Nama hewan wajib diisi.',
            'nama.min' => 'Nama hewan minimal 3 huruf!',
            'nama.unique' => 'Nama hewan sudah ada!',
            'jenis.required' => 'Jenis hewan wajib diisi.',
            'jenis.min' => 'Jenis hewan minimal 3 huruf!',
        ]);

        $hewan->update(($validated));

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil di update!');
    }
    public function destroy($id) // Controller untuk menghapus data hewan
    {
        $hewan = Hewan::findOrFail($id);
        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil di hapus!');
    }
}
