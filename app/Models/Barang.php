<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Nama tabel
    protected $primaryKey = 'id_barang'; // Karena bukan 'id' default
    public $timestamps = false; 

    protected $fillable = [
        'nama_barang',
        'merek',
        'spesifikasi',
        'foto',
    ];
}