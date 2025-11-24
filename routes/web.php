<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Routing\Controllers\Middleware;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->middleware('islogin')->group(function () {
    Route::get('/', [AuthController::class, 'login_page'])->name('login-page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware("guru")->group(function () {
    Route::get('', function () {
        return redirect()->route('guru.dashboard-siswa-page');
    });
    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'dashboard_siswa_page'])->name('guru.dashboard-siswa-page');
        Route::get('/tambah-siswa', [SiswaController::class, 'tambah_siswa_page'])->name('guru.tambah-siswa-page');
        Route::post('/tambah-siswa/kirim', [SiswaController::class, 'tambah_siswa'])->name('guru.tambah-siswa');
        Route::get('/edit-siswa/{id}', [SiswaController::class, 'edit_siswa_page'])->name('guru.edit-siswa-page');
        Route::put('/edit-siswa/{id}/kirim', [SiswaController::class, 'edit_siswa'])->name('guru.edit-siswa');
        Route::delete('/delete-siswa/{id}', [SiswaController::class, 'delete_siswa'])->name('guru.delete-siswa');
    });
    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'dashboard_guru_page'])->name('guru.dashboard-guru-page');
        Route::get('/tambah-guru', [GuruController::class, 'tambah_guru_page'])->name('guru.tambah-guru-page');
        Route::post('/tambah-guru/kirim', [GuruController::class, 'tambah_guru'])->name('guru.tambah-guru');
        Route::get('/edit-guru/{id}', [GuruController::class, 'edit_guru_page'])->name('guru.edit-guru-page');
        Route::put('/edit-guru/{id}/kirim', [GuruController::class, 'edit_guru'])->name('guru.edit-guru');
        Route::delete('/delete-guru/{id}', [GuruController::class, 'delete_guru'])->name('guru.delete-guru');
    });
    Route::prefix('absensi')->group(function () {
        Route::get('/', [AbsensiController::class, 'dashboard_absensi_page'])->name('guru.dashboard-absensi-page');
        Route::get('/tambah/absensi', [AbsensiController::class, 'tambah_absensi_page'])->name('guru.tambah-absensi-page');
        Route::post('/tambah/absensi', [AbsensiController::class, 'tambah_absensi'])->name('guru.tambah-absensi');

    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

