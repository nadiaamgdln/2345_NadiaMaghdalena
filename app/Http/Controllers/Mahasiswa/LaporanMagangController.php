<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rule; 
use Illuminate\Routing\Controllers\Middleware;

#[Middleware('sudah.daftar.magang')]
class LaporanMagangController extends Controller
{
    // index() tidak kita pakai di sini, karena daftar laporan ada di dashboard.
    // Tapi bisa diisi jika ingin halaman khusus daftar laporan.
    // public function index() { ... }

    public function create()
    {
        return view('mahasiswa.laporan-magang.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'minggu_ke' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('laporan_magangs')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ],
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:500',
            'tanggal_laporan' => 'required|date',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx,zip,rar|max:10240', 
        ]);

        $filePath = null;
        if ($request->hasFile('file_laporan')) {
            // Nama folder: laporan_user_{id_user}/minggu_{minggu_ke}
            // Nama file: asli atau unik
            // Contoh path: public/laporan_magang/user_1/minggu_1_laporan_akhir.zip
            $file = $request->file('file_laporan');
            $fileName = 'minggu_' . $request->minggu_ke . '_' . time() . '.' . $file->getClientOriginalExtension();
            // Simpan ke 'storage/app/public/laporan_magang/user_{id}'
            $filePath = $file->storeAs('laporan_magang/user_' . $user->id, $fileName, 'public');
        }

        LaporanMagang::create([
            'user_id' => $user->id,
            'minggu_ke' => $request->minggu_ke,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'tanggal_laporan' => $request->tanggal_laporan,
            'file_laporan_path' => $filePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan magang berhasil ditambahkan.');
    }

    public function show(LaporanMagang $laporanMagang)
    {
        // Pastikan laporan ini milik user yang login
        if ($laporanMagang->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('mahasiswa.laporan-magang.show', compact('laporanMagang'));
    }

    public function edit(LaporanMagang $laporanMagang)
    {
        if ($laporanMagang->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('mahasiswa.laporan-magang.edit', compact('laporanMagang'));
    }

    public function update(Request $request, LaporanMagang $laporanMagang)
    {
        if ($laporanMagang->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $user = Auth::user();
        $request->validate([
            'minggu_ke' => [
                'required',
                'integer',
                'min:1',
                // Unik, tapi abaikan id laporan saat ini
                Rule::unique('laporan_magangs')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })->ignore($laporanMagang->id)
            ],
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:500',
            'tanggal_laporan' => 'required|date',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx,zip,rar|max:10240',
        ]);

        $filePath = $laporanMagang->file_laporan_path; // Path file lama
        if ($request->hasFile('file_laporan')) {
            // Hapus file lama jika ada dan jika file baru diupload
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $file = $request->file('file_laporan');
            $fileName = 'minggu_' . $request->minggu_ke . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('laporan_magang/user_' . $user->id, $fileName, 'public');
        }

        $laporanMagang->update([
            'minggu_ke' => $request->minggu_ke,
            'judul' => $request->judul,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'tanggal_laporan' => $request->tanggal_laporan,
            'file_laporan_path' => $filePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan magang berhasil diperbarui.');
    }

    public function destroy(LaporanMagang $laporanMagang)
    {
        if ($laporanMagang->user_id !== Auth::id()) {
            // abort(403, 'Akses ditolak.'); // Atau redirect dengan error
             return redirect()->route('dashboard')->with('error_message', 'Anda tidak punya hak untuk menghapus laporan ini.');
        }

        // Hapus file dari storage jika ada
        if ($laporanMagang->file_laporan_path && Storage::disk('public')->exists($laporanMagang->file_laporan_path)) {
            Storage::disk('public')->delete($laporanMagang->file_laporan_path);
        }

        $laporanMagang->delete();
        return redirect()->route('dashboard')->with('success', 'Laporan magang berhasil dihapus.');
    }
}