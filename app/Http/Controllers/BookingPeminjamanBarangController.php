<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman_barang_detail;
use Illuminate\Http\Request;

class BookingPeminjamanBarangController extends Controller
{
    // List Persetujuan (Admin)
    public function indexAdmin()
    {
        $details = Peminjaman_barang_detail::with([
            'peminjaman.user',
            'peminjaman_barang'
        ])->orderBy('id', 'desc')->get();

        $pendingCount = Peminjaman_barang_detail::where('status', 'pending')->count();

        return view('admin.peminjaman_barang.index', compact('details', 'pendingCount'));
    }

    // Update Status (Admin)
    public function updateStatus(Request $request, $id)
    { 
        // Validasi sesuai enum di database
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak,dikembalikan,rusak,hilang','ditolak',
        ]);
        // Ambil data peminjaman
        $detail = Peminjaman_barang_detail::findOrFail($id);

        // Update status & catatan
        $detail->update([
            'status'  => $request->status,
        ]);

        return back()->with('success', 'Status peminjaman barang berhasil diperbarui');
    }
}
