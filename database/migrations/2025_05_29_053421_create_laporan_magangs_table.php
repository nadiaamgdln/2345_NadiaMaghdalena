<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_magangs', function (Blueprint $table) {
            $table->id();
            // Bisa foreignId ke user_id atau pendaftaran_magang_id
            // Jika ke user_id, lebih simpel. Jika ke pendaftaran_magang_id, lebih terstruktur
            // Kita pakai user_id dulu untuk contoh ini, karena User sudah punya relasi hasMany LaporanMagang
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Jika mau pakai pendaftaran_magang_id:
            // $table->foreignId('pendaftaran_magang_id')->constrained('pendaftaran_magangs')->onDelete('cascade');

            $table->integer('minggu_ke');
            $table->string('judul');
            $table->text('deskripsi_singkat');
            $table->date('tanggal_laporan');
            $table->string('file_laporan_path')->nullable();
            $table->timestamps();

            // Pastikan kombinasi user_id dan minggu_ke unik, agar tidak ada laporan double untuk minggu yang sama
            $table->unique(['user_id', 'minggu_ke']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_magangs');
    }
};
