<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'merek',
        'spesifikasi',
        'foto',
    ];

    public function peminjaman_brg_detail():HasMany{
        return $this->hasMany(Peminjaman_barang_detail::class, 'barang_id', 'id_barang');
    }

    public function log_barang():HasMany{
        return $this->hasMany(Laporan_kerusakan::class, 'barang_id', 'id_barang');
    }

}
