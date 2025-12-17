<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BookingController; // Tambahkan ini
use App\Http\Controllers\PeminjamanBarangController; // Tambahkan ini
use App\Http\Controllers\BookingPeminjamanBarangController;
use App\Models\Lab;
use App\Models\Barang;

// --- RUTE AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

// RUTE LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

// --- RUTE HALAMAN UTAMA ---
Route::get('/', function () { 
    return redirect()->route('user.dashboard'); 
});

// Dashboard User (PUBLIC - Bisa diakses tanpa login)
Route::get('/dashboard', function () {
    $labs = Lab::all();
    return view('user.dashboard', compact('labs'));
})->name('user.dashboard');

// Jadwal (PUBLIC)
Route::get('/calendar', [BookingController::class, 'calendar'])->name('booking.calendar');
Route::get('/calendar/events', [BookingController::class, 'getEvents'])->name('booking.events');
// Detail Lab
Route::get('/lab/{id}', function ($id) {
    $lab = Lab::findOrFail($id);
    return view('user.detail_lab', compact('lab'));
})->name('lab.detail');


// --- RUTE PRIVATE USER (WAJIB LOGIN) ---
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    
    // Profil (Placeholder)
    Route::get('/profil', function() { return "<h1>Profil</h1>"; })->name('profil');

    // === FITUR PEMINJAMAN (BOOKING) ===
    Route::get('/booking/ajukan', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/simpan', [BookingController::class, 'store'])->name('booking.store');
    
    // Ganti route riwayat placeholder lama dengan Controller yang baru
    Route::get('/booking/riwayat', [BookingController::class, 'history'])->name('booking.history');
    // Download Format Surat Peminjaman
    Route::get('/booking/format/download', [BookingController::class, 'downloadFormat'])->name('booking.format.download');
    // Cetak Bukti Peminjaman
    Route::get('/booking/{id}/cetak', [BookingController::class, 'cetakBukti'])->name('booking.cetak');

    Route::get('/peminjaman_barang', [PeminjamanBarangController::class, 'index'])->name('index.barang');

});


// --- RUTE ADMIN (WAJIB LOGIN & ROLE ADMIN) ---
Route::middleware(['auth', 'isAdmin', 'prevent-back-history'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        // 1. Hitung Total Lab
        $totalLab = Lab::count();

        // 2. Hitung Total Barang (Jika tabel barang belum ada, anggap 0)
        $totalBarang = \Illuminate\Support\Facades\Schema::hasTable('barangs') ? Barang::count() : 0;

        // 3. Hitung Peminjaman Status 'pending'
        $totalPending = \Illuminate\Support\Facades\Schema::hasTable('peminjamens') 
                        ? Peminjaman::where('status', 'pending')->count() 
                        : 0;

        return view('admin.dashboard', compact('totalLab', 'totalBarang', 'totalPending'));
    })->name('admin.dashboard');

    // === CRUD KELOLA LAB ===
    Route::get('/kelola-lab', [LabController::class, 'index'])->name('admin.labs');
    Route::get('/kelola-lab/create', [LabController::class, 'create'])->name('admin.labs.create');
    Route::post('/kelola-lab/store', [LabController::class, 'store'])->name('admin.labs.store');
    Route::get('/kelola-lab/edit/{id}', [LabController::class, 'edit'])->name('admin.labs.edit');
    Route::put('/kelola-lab/update/{id}', [LabController::class, 'update'])->name('admin.labs.update');
    Route::delete('/kelola-lab/delete/{id}', [LabController::class, 'destroy'])->name('admin.labs.destroy');

    // === PERSETUJUAN PEMINJAMAN ===
    Route::get('/peminjaman', [BookingController::class, 'indexAdmin'])->name('admin.booking.index');
    Route::put('/peminjaman/{id}', [BookingController::class, 'updateStatus'])->name('admin.booking.update');
    Route::get('/pengaturan/format', [BookingController::class, 'settingFormat'])->name('admin.settings.format');
    Route::post('/pengaturan/format', [BookingController::class, 'updateFormat'])->name('admin.settings.update');
    Route::get('/peminjaman_barang', [BookingPeminjamanBarangController::class, 'indexAdmin'])->name('admin_booking_barang');
    Route::put('/peminjaman_barang/{id}', [BookingPeminjamanBarangController::class, 'updateStatus'])->name('admin_aprove_barang');

    // --- CRUD KELOLA BARANG ---
    Route::get('/kelola-barang', [BarangController::class, 'index'])->name('admin.barang');
    Route::get('/kelola-barang/create', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/kelola-barang/store', [BarangController::class, 'store'])->name('admin.barang.store');
    Route::get('/kelola-barang/edit/{id}', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/kelola-barang/update/{id}', [BarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/kelola-barang/delete/{id}', [BarangController::class, 'destroy'])->name('admin.barang.destroy');

});

Route::get('/form_peminjaman', [PeminjamanBarangController::class, 'create_form_peminjaman'])->name('form_peminjaman_brg.barang');
Route::post('/form_peminjaman/tambah_barang', [PeminjamanBarangController::class, 'tambahItem'])->name('tambah_barang');
Route::get('/form_peminjaman/reset_items', [PeminjamanBarangController::class, 'resetItems'])->name('reset_items');
Route::post('/form_peminjaman/simpan_peminjaman', [PeminjamanBarangController::class, 'simpanPeminjaman'])->name('simpan_peminjaman');
Route::get('/riwayat_peminjaman', [PeminjamanBarangController::class, 'create_riwayat_peminjaman'])->name('riwayat_peminjaman');
Route::get('/laporan_kerusakan', [PeminjamanBarangController::class, 'create_laporan_kerusakan'])->name('laporan_kerusakan');
Route::post('/laporan_kerusakan/simpan', [PeminjamanBarangController::class, 'store_kerusakan'])->name('store_laporan_kerusakan');