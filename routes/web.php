<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// --- RUTE ADMIN ---
use App\Http\Controllers\LabController;
use App\Models\Lab;
use App\Http\Controllers\BarangController;
use App\Models\Barang;

// --- RUTE AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

// RUTE LOGOUT (Hanya satu ini yang boleh ada)
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
Route::get('/jadwal', function(){ return "<h1>Jadwal</h1>"; })->name('jadwal');

// --- RUTE PRIVATE (WAJIB LOGIN) ---
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/riwayat', function(){ return "<h1>Riwayat</h1>"; })->name('riwayat');
    Route::get('/profil', function() { return "<h1>Profil</h1>"; })->name('profil');
});

Route::get('/lab/{id}', function ($id) {
    $lab = Lab::findOrFail($id);
    return view('user.detail_lab', compact('lab'));
})->name('lab.detail');

// ... di dalam group admin ...
Route::middleware(['auth', 'isAdmin', 'prevent-back-history'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // --- CRUD KELOLA LAB ---
    Route::get('/kelola-lab', [LabController::class, 'index'])->name('admin.labs');
    Route::get('/kelola-lab/create', [LabController::class, 'create'])->name('admin.labs.create');
    Route::post('/kelola-lab/store', [LabController::class, 'store'])->name('admin.labs.store');
    Route::get('/kelola-lab/edit/{id}', [LabController::class, 'edit'])->name('admin.labs.edit');
    Route::put('/kelola-lab/update/{id}', [LabController::class, 'update'])->name('admin.labs.update');
    Route::delete('/kelola-lab/delete/{id}', [LabController::class, 'destroy'])->name('admin.labs.destroy');

    // --- CRUD KELOLA BARANG ---
    Route::get('/kelola-barang', [BarangController::class, 'index'])->name('admin.barang');
    Route::get('/kelola-barang/create', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/kelola-barang/store', [BarangController::class, 'store'])->name('admin.barang.store');
    Route::get('/kelola-barang/edit/{id}', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/kelola-barang/update/{id}', [BarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/kelola-barang/delete/{id}', [BarangController::class, 'destroy'])->name('admin.barang.destroy');

});