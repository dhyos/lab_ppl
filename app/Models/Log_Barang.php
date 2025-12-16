<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_Barang extends Model
{
     protected $table = 'log_barang';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'keterangan',
        'tanggal',
    ];
}
