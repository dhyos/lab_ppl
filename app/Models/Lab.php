<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $table = 'lab'; // Nama tabel custom
    protected $primaryKey = 'id_lab'; // Primary key custom
    public $timestamps = false;
    protected $fillable = [
        'nama_lab',
        'kapasitas',
        'deskripsi',
        'id_admin',
        'dosen_pj',
        'gambar'
    ];

    // Relasi ke User (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}