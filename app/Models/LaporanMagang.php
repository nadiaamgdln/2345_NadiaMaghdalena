<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'pendaftaran_magang_id', // Jika pakai ini
        'minggu_ke',
        'judul',
        'deskripsi_singkat',
        'tanggal_laporan',
        'file_laporan_path',
    ];

    // Relasi ke User (Satu Laporan dimiliki oleh satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika pakai pendaftaran_magang_id
    // public function pendaftaranMagang()
    // {
    //     return $this->belongsTo(PendaftaranMagang::class);
    // }
}