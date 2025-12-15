<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    // Karena nama kolom foreign key bukan default (user_id), kita harus sebutkan
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lab() {
        return $this->belongsTo(Lab::class, 'id_lab');
    }
}