<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use Illuminate\Support\Facades\Storage;

class HewanController extends Controller
{
    // USER INDEX (khusus user biasa, tidak bisa CRUD)
    public function userIndex(Request $request)
    {
        $query = Hewan::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('jenis', 'like', '%' . $request->search . '%');
        }

        $datahewan = $query->orderBy('id', 'desc')->paginate(5);
        $datahewan->appends(['search' => $request->search]);

        return view('hewan.user_index', compact('datahewan'));
    }

    // ADMIN INDEX (khusus admin CRUD)
    public function index(Request $request)
    {
        $query = Hewan::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $datahewan = $query->orderBy('id', 'desc')->paginate(5);
        return view('hewan.admin_index', compact('datahewan'));
    }

    public function create()
    {
        return view('hewan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|min:3|unique:hewans,nama',
            'jenis' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('hewan', 'public');
            $validated['foto'] = $path;
        }

        Hewan::create($validated);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewan.edit', compact('hewan'));
    }

    public function update(Request $request, $id)
    {
        $hewan = Hewan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|min:3|unique:hewans,nama,' . $id,
            'jenis' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($hewan->foto && Storage::disk('public')->exists($hewan->foto)) {
                Storage::delete('public/' . $hewan->foto);
            }

            $path = $request->file('foto')->store('hewan', 'public');
            $validated['foto'] = $path;
        }

        $hewan->update($validated);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $hewan = Hewan::findOrFail($id);

        if ($hewan->foto && Storage::exists('public/' . $hewan->foto)) {
            Storage::delete('public/' . $hewan->foto);
        }

        $hewan->delete();

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil dihapus!');
    }

    public function adminIndex(Request $request)
    {
        $query = Hewan::query();

        // Fitur pencarian
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('jenis', 'like', '%' . $request->search . '%');
        }

        // Pagination 5 per halaman
        $datahewan = $query->orderBy('id', 'desc')->paginate(5);
        $datahewan->appends(['search' => $request->search]);

        return view('hewan.admin_index', compact('datahewan'));
    }
}
