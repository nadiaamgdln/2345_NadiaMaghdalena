<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Mahasiswa\PendaftaranMagangController;
use App\Http\Controllers\Mahasiswa\LaporanMagangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pendaftaran-magang', [PendaftaranMagangController::class, 'createOrEdit'])->name('pendaftaran-magang.form');
    Route::post('/pendaftaran-magang', [PendaftaranMagangController::class, 'storeOrUpdate'])->name('pendaftaran-magang.store');
    Route::resource('laporan-magang', LaporanMagangController::class)
         ->except(['index'])
         ->middleware('sudah.daftar.magang');
    
});

require __DIR__.'/auth.php';
