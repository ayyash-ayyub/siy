<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PewawancaraController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\UserGuruController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/calon-guru', [UserGuruController::class, 'index'])->name('calon-guru.index');
    Route::post('/calon-guru', [UserGuruController::class, 'store'])->name('calon-guru.store');
    Route::get('/calon-guru/{userGuru}/edit', [UserGuruController::class, 'edit'])->name('calon-guru.edit');
    Route::put('/calon-guru/{userGuru}', [UserGuruController::class, 'update'])->name('calon-guru.update');
    Route::delete('/calon-guru/{userGuru}', [UserGuruController::class, 'destroy'])->name('calon-guru.destroy');

    Route::get('/pewawancara', [PewawancaraController::class, 'index'])->name('pewawancara.index');
    Route::post('/pewawancara', [PewawancaraController::class, 'store'])->name('pewawancara.store');
    Route::get('/pewawancara/{pewawancara}/edit', [PewawancaraController::class, 'edit'])->name('pewawancara.edit');
    Route::put('/pewawancara/{pewawancara}', [PewawancaraController::class, 'update'])->name('pewawancara.update');
    Route::delete('/pewawancara/{pewawancara}', [PewawancaraController::class, 'destroy'])->name('pewawancara.destroy');

    Route::post('/penilaian/hasil', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/hasil-penilaian', [PenilaianController::class, 'index'])->name('hasil-penilaian.index');
    Route::delete('/hasil-penilaian/{hasilPenilaian}', [PenilaianController::class, 'destroy'])->name('hasil-penilaian.destroy');
    Route::get('/hasil-penilaian/export/csv', [PenilaianController::class, 'export'])->name('hasil-penilaian.export');
});
