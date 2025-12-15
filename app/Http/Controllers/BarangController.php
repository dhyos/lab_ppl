<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus/simpan foto

class BarangController extends Controller
{
    // 1. TAMPILKAN DATA
    public function index()
    {
        $barangs = Barang::orderBy('id_barang', 'desc')->get(); 
        return view('admin.barang.index', compact('barangs'));

    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.barang.create'); // Tidak butuh data lab lagi
    }

    // 3. SIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'merek'       => 'required|string|max:100',
            'spesifikasi' => 'required|string',
            'foto'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        // Upload Foto
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('barang-images', 'public');
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'merek'       => $request->merek,
            'spesifikasi' => $request->spesifikasi,
            'foto'        => $imagePath,
        ]);

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    // 5. UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'merek'       => 'required|string|max:100',
            'spesifikasi' => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable agar tidak wajib upload ulang
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->only(['nama_barang', 'merek', 'spesifikasi']);

        // Cek jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto && Storage::exists('public/' . $barang->foto)) {
                Storage::delete('public/' . $barang->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('barang-images', 'public');
        }

        $barang->update($data);

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil diperbarui');
    }

    // 6. HAPUS DATA
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file foto dari storage sebelum hapus record db
        if ($barang->foto && Storage::exists('public/' . $barang->foto)) {
            Storage::delete('public/' . $barang->foto);
        }

        $barang->delete();

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil dihapus');
    }
}