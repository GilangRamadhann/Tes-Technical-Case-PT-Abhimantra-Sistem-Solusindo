<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login'); // saat buka '/', diarahkan ke login

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Siswa
    Route::get('/siswa', [SiswaController::class,'index'])->name('siswa.index');
    Route::post('/siswa', [SiswaController::class,'store'])->name('siswa.store');
    Route::put('/siswa/{siswa}', [SiswaController::class,'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class,'destroy'])->name('siswa.destroy');

    // Nilai
    Route::get('/nilai', [NilaiController::class,'index'])->name('nilai.index');
    Route::post('/nilai', [NilaiController::class,'store'])->name('nilai.store');
    Route::put('/nilai/{nilai}', [NilaiController::class,'update'])->name('nilai.update');
    Route::delete('/nilai/{nilai}', [NilaiController::class,'destroy'])->name('nilai.destroy');

    // Import/Export
    Route::post('/nilai/import', [NilaiController::class,'import'])->name('nilai.import');
    Route::get('/nilai/export', [NilaiController::class,'export'])->name('nilai.export');
});

require __DIR__.'/auth.php';
