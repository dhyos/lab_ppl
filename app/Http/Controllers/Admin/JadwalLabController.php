<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalLab;
use App\Models\Lab;
use Illuminate\Http\Request;

class JadwalLabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = JadwalLab::with('lab')->orderBy('id', 'desc')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labs = Lab::all();
        // dd($labs->toArray()); // Debug labs as array
        return view('admin.jadwal.create', compact('labs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required|exists:lab,id_lab',
            'hari' => 'required|string',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required|string',
        ]);

        // Cek konflik jadwal
        $conflict = JadwalLab::where('lab_id', $request->lab_id)
            ->where('hari', $request->hari)
            ->where(function ($q) use ($request) {
                if ($request->tanggal) {
                    $q->where('tanggal', $request->tanggal)->orWhereNull('tanggal');
                } else {
                    $q->whereNull('tanggal');
                }
            })
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })
            ->exists();

        if ($conflict) {
            $lab = Lab::find($request->lab_id);
            return back()->withInput()->with('error', 'Jadwal bentrok! ' . $lab->nama_lab . ' pada ' . ucfirst($request->hari) . ' ' . ($request->tanggal ?? 'setiap minggu') . ' jam ' . $request->jam_mulai . '-' . $request->jam_selesai . ' sudah terpakai.');
        }

        try {
            JadwalLab::create(array_merge($request->all(), ['status' => 'terpakai']));
            return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalLab::findOrFail($id);
        $labs = Lab::all();
        return view('admin.jadwal.edit', compact('jadwal', 'labs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lab_id' => 'required|exists:lab,id_lab',
            'hari' => 'required|string',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required|string',
        ]);

        $jadwal = JadwalLab::findOrFail($id);

        // Check if conflict-related fields changed
        $fieldsChanged = $jadwal->lab_id != $request->lab_id ||
            $jadwal->hari != $request->hari ||
            $jadwal->tanggal != $request->tanggal ||
            $jadwal->jam_mulai != $request->jam_mulai ||
            $jadwal->jam_selesai != $request->jam_selesai;

        if ($fieldsChanged) {
            // Check for conflicts only if fields changed
            $conflict = JadwalLab::where('lab_id', $request->lab_id)
                ->where('hari', $request->hari)
                ->where('id', '!=', $id) // Exclude current record
                ->where(function ($q) use ($request) {
                    if ($request->tanggal) {
                        $q->where('tanggal', $request->tanggal)->orWhereNull('tanggal');
                    } else {
                        $q->whereNull('tanggal');
                    }
                })
                ->where(function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('jam_mulai', '<', $request->jam_selesai)
                          ->where('jam_selesai', '>', $request->jam_mulai);
                    });
                })
                ->exists();

            if ($conflict) {
                $lab = Lab::find($request->lab_id);
                return back()->withInput()->with('error', 'Jadwal bentrok! ' . $lab->nama_lab . ' pada ' . ucfirst($request->hari) . ' ' . ($request->tanggal ?? 'setiap minggu') . ' jam ' . $request->jam_mulai . '-' . $request->jam_selesai . ' sudah terpakai.');
            }
        }

        $jadwal->update([
            'lab_id' => $request->lab_id,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
            'status' => 'terpakai',
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalLab::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
