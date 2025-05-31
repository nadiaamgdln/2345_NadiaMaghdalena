<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranMagangController extends Controller
{
    // Menampilkan form create atau edit
    public function createOrEdit()
    {
        $user = Auth::user();
        // Cek apakah user sudah punya data pendaftaran magang
        $pendaftaran = PendaftaranMagang::where('user_id', $user->id)->first();

        // Daftar dosen pembimbing (contoh, bisa dari database atau config)
        $dosenPembimbingOptions = [
            'Dr. Budi Santoso, M.Kom.',
            'Prof. Dr. Ir. Siti Aminah, M.T.',
            'Ahmad Subarjo, S.Kom., M.Cs.',
            'Retno Wulandari, S.T., M.Eng.',
        ];

        if ($pendaftaran) {
            // Jika sudah ada, tampilkan form edit dengan data yang ada
            return view('mahasiswa.pendaftaran-magang.form', [
                'pendaftaran' => $pendaftaran,
                'user' => $user,
                'isEdit' => true, // Tandai ini mode edit
                'dosenPembimbingOptions' => $dosenPembimbingOptions,
            ]);
        } else {
            // Jika belum, tampilkan form kosong untuk create
            return view('mahasiswa.pendaftaran-magang.form', [
                'pendaftaran' => new PendaftaranMagang(), // Kirim objek kosong
                'user' => $user,
                'isEdit' => false, // Tandai ini mode create
                'dosenPembimbingOptions' => $dosenPembimbingOptions,
            ]);
        }
    }

    // Menyimpan atau mengupdate data pendaftaran
    public function storeOrUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'semester_ke' => 'required|string|max:20',
            'dosen_pembimbing' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'lokasi_magang' => 'required|string|max:255',
        ]);

        // Cari atau buat baru (updateOrCreate)
        // Kunci pencarian adalah user_id, data yang diupdate/dibuat adalah sisanya
        PendaftaranMagang::updateOrCreate(
            ['user_id' => $user->id],
            [
                'semester_ke' => $request->semester_ke,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'instansi' => $request->instansi,
                'lokasi_magang' => $request->lokasi_magang,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Data pendaftaran magang berhasil disimpan!');
    }
}