<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti 'labs' menjadi 'lab'
        Schema::table('lab', function (Blueprint $table) {
            // Kita gunakan nama kolom Indonesia sesuai database Anda
            // 'kapasitas' adalah nama kolom yang ada di db_peminjaman.sql
            $table->string('dosen_pj')->nullable()->after('kapasitas'); 
            
            // 'deskripsi' adalah nama kolom yang ada di db_peminjaman.sql
            $table->text('aturan')->nullable()->after('deskripsi'); 
        });
    }

    public function down(): void
    {
        Schema::table('lab', function (Blueprint $table) {
            $table->dropColumn(['dosen_pj', 'aturan']);
        });
    }
};