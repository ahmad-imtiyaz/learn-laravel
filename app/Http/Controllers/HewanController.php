<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use Illuminate\Support\Facades\Storage;


class HewanController extends Controller
{
    public function index(Request $request) // Controller untuk menampilkan daftar hewan
    {
        $query = Hewan::query();

        // Cek apakah ada input pencarian 
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search  . '%')
                ->orWhere('jenis', 'like', '%' . $request->search . '%');
        }

        // pagenation tetap jalan (5 data per halaman)  
        $datahewan = $query->orderBy('id', 'desc')->paginate(5);

        // Biar pagenation tetap membawa query search-nya
        $datahewan->appends(['search' => $request->search]);

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama hewan wajib diisi.',
            'nama.min' => 'Nama hewan minimal 3 huruf!',
            'nama.unique' => 'Nama hewan sudah ada!',
            'jenis.required' => 'Jenis hewan wajib diisi.',
            'jenis.min' => 'Jenis hewan minimal 3 huruf!',
        ]);

        // Jika ada fota simpan ke storage 
        if ($request->hasFile('foto')) {
            // Simpan di folder storage/app/public/hewan
            $path = $request->file('foto')->store('hewan', 'public');
            $validated['foto'] = $path; // simpan path-nya ke array validated
        }
        // SIMPAN KE DATABASE
        Hewan::create($validated);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function edit($id) // Controller untuk menampilkan form edit data hewan
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.edit', compact('hewan'));
    }

    public function update(Request $request, $id) // Controller untuk mengupdate data hewan
    {
        $hewan = Hewan::findOrFail($id);

        // VALIDASI UPDATE (ABAIKAN DATA SENDIRI PADA UNIQUE)
        $validated = $request->validate([
            'nama' => 'required|min:3|unique:hewans,nama,' . $id,
            'jenis' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama hewan wajib diisi.',
            'nama.min' => 'Nama hewan minimal 3 huruf!',
            'nama.unique' => 'Nama hewan sudah ada!',
            'jenis.required' => 'Jenis hewan wajib diisi.',
            'jenis.min' => 'Jenis hewan minimal 3 huruf!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif svg!',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($hewan->foto && Storage::disk('public')->exists($hewan->foto)) {
                Storage::delete('public/' . $hewan->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('hewan', 'public');
            $validated['foto'] = $path; // simpan path-nya ke array validated
        }

        // Update data ke database
        $hewan->update($validated);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $hewan = Hewan::findOrFail($id);

        // cek dan hapus foto lama jika ada
        if ($hewan->foto && Storage::exists('public/' . $hewan->foto)) {
            Storage::delete('public/' . $hewan->foto);
        }

        // hapus data dari database
        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil dihapus!');
    }
}
