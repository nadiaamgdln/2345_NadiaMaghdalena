<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PendaftaranMagang;
use App\Models\User;

class PendaftaranMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAndi = User::where('npm', '1234567890')->first();
        if ($userAndi) {
            PendaftaranMagang::create([
                'user_id' => $userAndi->id,
                'semester_ke' => '7',
                'dosen_pembimbing' => 'Dr. Budi Santoso, M.Kom.',
                'instansi' => 'PT. Teknologi Maju',
                'lokasi_magang' => 'Jakarta Pusat',
            ]);
        }
    }
}
