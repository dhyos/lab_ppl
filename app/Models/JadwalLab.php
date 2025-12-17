<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalLab extends Model
{
    public $timestamps = false; // Disable timestamps

    protected $table = 'jadwal_lab';

    protected $fillable = [
        'lab_id',
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
        'kegiatan',
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
