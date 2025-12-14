<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (id_user)
            $table->integer('id_user'); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            // Relasi ke Lab (id_lab)
            $table->integer('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('lab')->onDelete('cascade');

            // Data Peminjaman (Bahasa Indonesia)
            $table->date('tanggal_pinjam');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('keperluan');
            $table->string('file_surat'); // Path file
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_penolakan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};