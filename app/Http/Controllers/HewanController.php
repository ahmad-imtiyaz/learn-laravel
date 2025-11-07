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
        $request->validate([
            'nama' => 'required|min:3',
            'jenis' => 'required'
        ]);

        Hewan::create($request->only('nama', 'jenis'));
        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil di tambahkan!');
    }

    public function edit($id) // Controller untuk menampilkan form edit data hewan
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.edit', compact('hewan'));
    }

    public function update(Request $request, $id) // Controller untuk mengupdate data hewan
    {
        $hewan = Hewan::findOrFail($id);
        $hewan->update($request->only('nama', 'jenis'));

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil di update!');
    }

    public function destroy($id) // Controller untuk menghapus data hewan
    {
        $hewan = Hewan::findOrFail($id);
        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil di hapus!');
    }
}
