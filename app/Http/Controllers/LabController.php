<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;

class LabController extends Controller
{
    // 1. READ (Tampilkan Data)
    public function index()
    {
        // Ambil semua data lab beserta info admin pembuatnya
        $labs = Lab::with('admin')->get(); 
        return view('admin.labs.index', compact('labs'));
    }

    // 2. CREATE (Tampilkan Form Tambah)
    public function create()
    {
        // Cari user yang rolenya 'admin' untuk dropdown
        $admins = User::where('role', 'admin')->get();
        return view('admin.labs.create', compact('admins'));
    }

    // 3. STORE (Simpan Data Baru)
    public function store(Request $request)
    {
        $request->validate([
            'nama_lab' => 'required',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'required',
            'id_admin'  => 'required',
        ]);

        Lab::create($request->all());

        return redirect()->route('admin.labs')->with('success', 'Lab berhasil ditambahkan');
    }

    // 4. EDIT (Tampilkan Form Edit)
    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        $admins = User::where('role', 'admin')->get();
        return view('admin.labs.edit', compact('lab', 'admins'));
    }

    // 5. UPDATE (Simpan Perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lab' => 'required',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'required',
            'id_admin'  => 'required',
        ]);

        $lab = Lab::findOrFail($id);
        $lab->update($request->all());

        return redirect()->route('admin.labs')->with('success', 'Data Lab berhasil diupdate');
    }

    // 6. DELETE (Hapus Data)
    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        return redirect()->route('admin.labs')->with('success', 'Lab berhasil dihapus');
    }
}