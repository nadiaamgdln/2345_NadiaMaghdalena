<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftaranMagang;
use Symfony\Component\HttpFoundation\Response;

class PastikanSudahDaftarMagang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Cek relasi pendaftaranMagang atau query langsung
            // Jika menggunakan relasi di model User: if (!$user->pendaftaranMagang) {
            // Atau query langsung:
            $pendaftaranExists = PendaftaranMagang::where('user_id', $user->id)->exists();

            if (!$pendaftaranExists) {
                // Jika belum ada data pendaftaran magang, redirect ke form pendaftaran
                // dan kasih pesan
                return redirect()->route('pendaftaran-magang.form')
                                 ->with('warning', 'Anda harus melengkapi data pendaftaran magang terlebih dahulu.');
            }
        }
        return $next($request);
    }
}
