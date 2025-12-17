<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id'; // Sesuaikan nama tabel
    public $timestamps = false; // Tabel user di SQL Anda tidak punya kolom created_at/updated_at

    protected $fillable = [
        'nama', // Di SQL kolomnya 'nama', bukan 'name'
        'nim',
        'email',
        'password',
        'role',
    ];

    // Sembunyikan password
    protected $hidden = [
        'password',
    ];

    public function Bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'id_user');
    }

    public function PeminjamanBarang()
    {
        return $this->hasMany(\App\Models\Peminjaman_barang::class, 'id_user');
    }
}