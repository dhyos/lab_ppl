<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lab;
use App\Models\FormatSurat; // Pastikan Model ini di-import!
use App\Models\JadwalLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusMail;

class BookingController extends Controller
{
    // --- 1. FITUR UTAMA (User & Admin) ---

    // Form Peminjaman (User)
    public function create()
    {
        $labs = Lab::all();
        return view('user.bookings.create', compact('labs'));
    }

    // Simpan Peminjaman (User)
    public function store(Request $request)
    {
        $request->validate([
            'id_lab' => 'required',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'dokumen' => 'required|mimes:pdf,jpg,png|max:2048', 
            'keperluan' => 'required',
        ]);

        // Cek Bentrok
        $isBooked = Booking::where('id_lab', $request->id_lab)
            ->where('tanggal_pinjam', $request->tanggal_pinjam)
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })->exists();

        if ($isBooked) {
            return back()->with('error', 'Gagal! Jadwal tersebut sudah terisi.');
        }

        // Simpan File Surat Mahasiswa
        $path = $request->file('dokumen')->store('surat_peminjaman', 'public');

        Booking::create([
            'id_user' => Auth::id(),
            'id_lab' => $request->id_lab,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'file_surat' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.history')->with('success', 'Pengajuan berhasil!');
    }

    // Riwayat (User)
    public function history()
    {
        $bookings = Booking::where('id_user', Auth::id())->with('lab')->latest()->get();
        return view('user.bookings.history', compact('bookings'));
    }

    // List Peminjaman (Admin)
    public function indexAdmin()
    {
        $bookings = Booking::with(['user', 'lab'])->latest()->get();
        $pendingCount = Booking::where('status', 'pending')->count();
        return view('admin.bookings.index', compact('bookings', 'pendingCount'));
    }

    // Update Status (Admin)
    public function updateStatus(Request $request, $id)
        {
            // Gunakan findOrFail dengan eager loading user dan lab agar data email lengkap
            $booking = Booking::with(['user', 'lab'])->findOrFail($id);
            
            // Update data di database
            $booking->update([
                'status' => $request->status,
                'catatan_penolakan' => $request->catatan_penolakan,
            ]);

            try {
                if ($booking->user && $booking->user->email) {
                    Mail::to($booking->user->email)->send(new BookingStatusMail($booking));
                }
            } catch (\Exception $e) {
                return back()->with('success', 'Status diperbarui, namun Email notifikasi gagal terkirim (Cek koneksi internet/SMTP).');
            }

            return back()->with('success', 'Status diperbarui dan notifikasi email telah dikirim ke mahasiswa.');
        }

    // Download Format (User)
    public function downloadFormat()
        {
            // 1. Ambil data dari database
            $format = FormatSurat::where('jenis', 'peminjaman_lab')->latest()->first();

            if (!$format) {
                return back()->with('error', 'Format surat belum diatur oleh Admin.');
            }

            // 2. Cek fisik file
            $filePath = storage_path('app/public/' . $format->file_path);
            
            if (!file_exists($filePath)) {
                return back()->with('error', 'File fisik surat hilang. Hubungi Admin.');
            }

            // --- PERBAIKAN DI SINI ---
            // Deteksi ekstensi asli file (pdf/docx)
            $extension = pathinfo($filePath, PATHINFO_EXTENSION); 
            
            // Gunakan ekstensi tersebut untuk nama file download
            // Contoh hasil: "Format_Peminjaman_Lab.pdf"
            return response()->download($filePath, 'Format_Peminjaman_Lab.' . $extension);
        }

    // Halaman Setting (Admin)
    public function settingFormat()
    {
        return view('admin.settings.format');
    }

    // Proses Upload (Admin)
    public function updateFormat(Request $request)
    {
        $request->validate([
            'format_file' => 'required|mimes:doc,docx,pdf|max:5120',
        ]);

        // Hapus file lama jika ada (Biar storage hemat)
        $oldFormat = FormatSurat::where('jenis', 'peminjaman_lab')->latest()->first();
        if ($oldFormat && file_exists(storage_path('app/public/' . $oldFormat->file_path))) {
            unlink(storage_path('app/public/' . $oldFormat->file_path));
        }

        // Upload file baru ke folder 'formats'
        $path = $request->file('format_file')->store('formats', 'public');

        // Simpan path ke Database
        FormatSurat::updateOrCreate(
            ['jenis' => 'peminjaman_lab'],
            ['file_path' => $path]
        );

        // Redirect kembali ke halaman list admin
        return redirect()->route('admin.booking.index')->with('success', 'Format surat berhasil diperbarui!');
    }

    // Cetak Bukti Peminjaman (PDF)
    public function cetakBukti($id)
        {
            // Update: Tambahkan "with(['user', 'lab'])"
            $booking = Booking::with(['user', 'lab'])
                ->where('id', $id)
                ->where('id_user', Auth::id())
                ->firstOrFail();

            if ($booking->status != 'approved') {
                return back()->with('error', 'Hanya peminjaman yang disetujui yang bisa dicetak.');
            }

            $pdf = Pdf::loadView('pdf.bukti_peminjaman', compact('booking'));
            
            return $pdf->stream('Bukti_Peminjaman_' . $booking->id . '.pdf');
        }

    // 1. Tampilkan Halaman Kalender
    public function calendar()
    {
        return view('user.bookings.calendar');
    }

    // 2. Ambil Data JSON untuk FullCalendar
    public function getEvents()
    {
        // Ambil semua booking yang statusnya approved atau pending
        $bookings = Booking::with(['lab', 'user'])
            ->whereIn('status', ['approved', 'pending'])
            ->get();

        $events = [];

        foreach ($bookings as $booking) {
            // Tentukan warna berdasarkan kegiatan dan status
            $kegiatan = strtolower($booking->keperluan);
            $baseColor = '#3b82f6'; // Default biru
            if (strpos($kegiatan, 'kuliah') !== false || strpos($kegiatan, 'mata kuliah') !== false) {
                $baseColor = '#10b981'; // Hijau
            } elseif (strpos($kegiatan, 'praktikum') !== false) {
                $baseColor = '#e7f33bff'; // Kuning
            }

            // Jika pending, gunakan warna orange
            $color = $booking->status === 'pending' ? '#f97316' : $baseColor;
            $events[] = [
                'title' => $booking->jam_mulai . '-' . $booking->jam_selesai . ' | ' . $booking->lab->nama_lab,
                'start' => $booking->tanggal_pinjam . 'T' . $booking->jam_mulai,
                'end'   => $booking->tanggal_pinjam . 'T' . $booking->jam_selesai,
                'color' => $color,
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'type' => 'booking',
                    'lab' => $booking->lab->nama_lab,
                    'waktu' => $booking->jam_mulai . ' - ' . $booking->jam_selesai,
                    'kegiatan' => $booking->keperluan,
                    'user' => $booking->user->nama ?? 'User Terhapus',
                    'status' => $booking->status,
                ],
            ];
        }

        // Ambil jadwal lab
        $jadwalLabs = JadwalLab::with('lab')->get();

        $hariMap = [
            'minggu' => 0,
            'senin' => 1,
            'selasa' => 2,
            'rabu' => 3,
            'kamis' => 4,
            'jumat' => 5,
            'sabtu' => 6,
        ];

        foreach ($jadwalLabs as $jadwal) {
            $kegiatan = strtolower($jadwal->kegiatan);
            if ($kegiatan == 'mata kuliah') {
                $color = '#10b981'; // Hijau
            } elseif ($kegiatan == 'praktikum') {
                $color = '#f59e0b'; // Kuning
            } else {
                $color = '#3b82f6'; // Default biru
            }

            $hariLower = strtolower($jadwal->hari);
            $dayOfWeek = isset($hariMap[$hariLower]) ? $hariMap[$hariLower] : null;

            if ($dayOfWeek !== null) {
                $events[] = [
                    'title' => $jadwal->jam_mulai . '-' . $jadwal->jam_selesai . ' | ' . $jadwal->lab->nama_lab,
                    'daysOfWeek' => [$dayOfWeek],
                    'startTime' => $jadwal->jam_mulai,
                    'endTime' => $jadwal->jam_selesai,
                    'color' => $color,
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'type' => 'jadwal',
                        'lab' => $jadwal->lab->nama_lab,
                        'waktu' => $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai,
                        'kegiatan' => $jadwal->kegiatan,
                        'status' => $jadwal->status,
                    ],
                ];
            }
        }

        return response()->json($events);
    }
}