<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'semester_ke',
        'dosen_pembimbing',
        'instansi',
        'lokasi_magang',
    ];

    // Relasi ke User (Satu PendaftaranMagang dimiliki oleh satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke LaporanMagang (Satu PendaftaranMagang bisa punya banyak Laporan) (akan dibuat nanti)
    public function laporanMagangs()
    {
        return $this->hasMany(LaporanMagang::class);
    }
}