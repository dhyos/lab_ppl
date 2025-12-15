<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\BookingController; // Tambahkan ini
use App\Models\Lab;
use App\Models\Barang;       // Jangan lupa import ini
use App\Models\Peminjaman;

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

    // Kelola Barang (Biarkan dulu)
    Route::get('/kelola-barang', function () {
        return view('admin.kelola_barang');
    })->name('admin.items');
});