<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class LabController extends Controller
{
    // 1. READ (Tampilkan Data)
    public function index()
    {
        $labs = Lab::with('admin')->get(); 
        return view('admin.labs.index', compact('labs'));
    }

    // 2. CREATE (Tampilkan Form Tambah)
    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.labs.create', compact('admins'));
    }

    // 3. STORE (Simpan Data Baru)
    public function store(Request $request)
    {
        $request->validate([
            'nama_lab'  => 'required',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'required',
            'id_admin'  => 'required',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dosen_pj'  => 'required',
        ]);

        // Ambil semua input KECUALI gambar (agar bersih)
        $data = $request->except('gambar');

        // Logic Upload Gambar
        if ($request->hasFile('gambar')) {
            // Simpan ke storage/app/public/labs
            $path = $request->file('gambar')->store('labs', 'public');
            
            // Masukkan path bersih (contoh: 'labs/foto.jpg') ke array data
            $data['gambar'] = $path; 
        }

        Lab::create($data);

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
            'nama_lab'  => 'required',
            'kapasitas' => 'required|numeric',
            'deskripsi' => 'required',
            'id_admin'  => 'required',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dosen_pj'  => 'required',
        ]);

        $lab = Lab::findOrFail($id);
        
        // Ambil semua input KECUALI gambar
        $data = $request->except('gambar');

        // Cek jika user mengupload gambar baru
        if ($request->hasFile('gambar')) {
            
            // 1. Hapus gambar lama jika ada (Biar storage tidak penuh)
            if ($lab->gambar && Storage::disk('public')->exists($lab->gambar)) {
                Storage::disk('public')->delete($lab->gambar);
            }
            
            // 2. Upload gambar baru
            $path = $request->file('gambar')->store('labs', 'public');
            
            // 3. Masukkan path baru ke array data
            $data['gambar'] = $path;
        }

        // PERBAIKAN PENTING: Gunakan $data, JANGAN $request->all()
        $lab->update($data);

        return redirect()->route('admin.labs')->with('success', 'Data Lab berhasil diupdate');
    }

    // 6. DELETE (Hapus Data)
    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);

        // Hapus file gambar dari penyimpanan jika ada
        if ($lab->gambar && Storage::disk('public')->exists($lab->gambar)) {
            Storage::disk('public')->delete($lab->gambar);
        }

        // Hapus data dari database
        $lab->delete();

        return redirect()->route('admin.labs')->with('success', 'Lab berhasil dihapus');
    }
}