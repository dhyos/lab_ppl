<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laporan_kerusakan;
use App\Models\Peminjaman_barang;
use App\Models\Peminjaman_barang_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanBarangController extends Controller
{
    public function index(){
        $barang = Barang::all();
        return view('peminjaman_barang.view', compact('barang'));
    }
    public function create_form_peminjaman(){
        $barang = Barang::all();
        return view('peminjaman_barang.form_peminjaman', compact('barang'));
    }
    public function create_laporan_kerusakan(){
        $barang = Barang::all();
        return view('peminjaman_barang.laporan_kerusakan', compact('barang'));
    }
        public function create_riwayat_peminjaman()
        {
            $id_user = Auth::id(); 
            $detail_pinjam = Peminjaman_barang_detail::with([
                'peminjaman',
                'peminjaman_barang'
            ])->get();

            return view('peminjaman_barang.riwayat_peminjaman', compact('detail_pinjam', 'id_user'));
        }


    public function tambahItem(Request $request)
    {
        $items = session()->get('items', []);

        $items[] = [
            'barang_id' => $request->barang,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
        ];

        session()->put('items', $items);
        return back();
}
        public function resetItems()
        {
            session()->forget('items'); 
            return back()->with('success', 'Keranjang berhasil di-reset.');
        }

        public function simpanPeminjaman(Request $request)
        {
            $request->validate([
                'tanggal_pinjam' => 'required|date',
                'surat_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $filePath = $request->file('surat_file')->store('surat', 'public');
            
            $id_user = Auth::id();
            
            $peminjaman = Peminjaman_barang::create([
                'id_user' => $id_user,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'surat_file' => $filePath,
            ]);

            $items = session()->get('items', []);
            foreach ($items as $item) {
                Peminjaman_barang_detail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'status' => 'pending',
                    'catatan' => $item['catatan'],
                ]);
            }

            session()->forget('items');

            return redirect()->route('form_peminjaman_brg.barang')->with('success', 'Peminjaman berhasil disimpan!');
        }

        public function store_kerusakan(Request $request)
    {

        Laporan_kerusakan::create([
            'peminjaman_detil_id' => $request->peminjaman_detil_id,
            'deskripsi' => $request->deskripsi,
            'biaya_perbaikan' => $request->biaya_perbaikan,
            'status' => $request->status,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Laporan kerusakan berhasil disimpan');
    }



}
