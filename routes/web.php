<?php

use App\Http\Controllers\Admin\BentukKepatuhanController;
use App\Http\Controllers\Admin\BentukPelanggaranController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KategoriKepatuhanController;
use App\Http\Controllers\Admin\KategoriPelanggaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SanksiPelanggaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\WaliMuridController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route untuk Guest (Belum Login)
|--------------------------------------------------------------------------
| Hanya pengguna yang belum login yang dapat mengakses route di bawah ini.
| Digunakan untuk menampilkan halaman login dan proses autentikasi.
*/

Route::middleware('guest')->group(function () {
    // Halaman login
    Route::get('/', [AuthController::class, 'login'])->name('login');
    // Aksi login ketika form login disubmit
    Route::post('/', [AuthController::class, 'actionLogin'])->name('login');
});

/*
|--------------------------------------------------------------------------
| Route untuk User yang Sudah Login (Auth Middleware)
|--------------------------------------------------------------------------
| Semua route di sini hanya boleh diakses setelah user berhasil login.
| Berisi halaman dashboard dan seluruh menu manajemen data.
*/
Route::middleware('auth')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Menu Kelas
    |--------------------------------------------------------------------------
    */
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index'); // List kelas
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store'); // Proses tambah kelas
    Route::get('/kelas/{id}/edit', [KelasController::class, 'show'])->name('kelas.show'); // Edit kelas
    Route::post('/kelas/{id}/update', [KelasController::class, 'update'])->name('kelas.update'); // Proses update kelas
    Route::get('/kelas/{id}/delete', [KelasController::class, 'destroy'])->name('kelas.destroy'); // Hapus Kelas

    /*
    |--------------------------------------------------------------------------
    | Menu Siswa
    |--------------------------------------------------------------------------
    */
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index'); // List siswa
    Route::get('/siswa/tambah', [SiswaController::class, 'create'])->name('siswa.create'); // Tambah siswa
    Route::get('/siswa/edit', [SiswaController::class, 'edit'])->name('siswa.edit'); // Edit siswa

    /*
    |--------------------------------------------------------------------------
    | Menu Guru
    |--------------------------------------------------------------------------
    */
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index'); // List guru
    Route::get('/guru/tambah', [GuruController::class, 'create'])->name('guru.create'); // Tambah guru
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store'); // Proses tambah guru
    Route::get('/guru/{id}/edit', [GuruController::class, 'show'])->name('guru.show'); // Edit guru / detail guru
    Route::post('/guru/{id}/update', [GuruController::class, 'update'])->name('guru.update'); // Proses update guru
    Route::get('/guru/{id}/delete', [GuruController::class, 'destroy'])->name('guru.destroy'); // Hapus guru

    /*
    |--------------------------------------------------------------------------
    | Menu Wali Murid
    |--------------------------------------------------------------------------
    */
    Route::get('/wali-murid', [WaliMuridController::class, 'index'])->name('wali-murid.index'); // List wali murid
    Route::get('/wali-murid/tambah', [WaliMuridController::class, 'create'])->name('wali-murid.create'); // Tambah wali murid
    Route::get('/wali-murid/edit', [WaliMuridController::class, 'show'])->name('wali-murid.show'); // Edit wali murid
    Route::get('/wali-murid/siswa', [WaliMuridController::class, 'siswa'])->name('wali-murid.siswa'); // Relasi wali murid ke siswa

    /*
    |--------------------------------------------------------------------------
    | Menu Kategori Pelanggaran
    |--------------------------------------------------------------------------
    */
    Route::get('/kategori-pelanggaran', [KategoriPelanggaranController::class, 'index'])->name('kategori-pelanggaran.index'); // List kategori pelanggaran

    /*
    |--------------------------------------------------------------------------
    | Menu Bentuk Pelanggaran
    |--------------------------------------------------------------------------
    */
    Route::get('/bentuk-pelanggaran', [BentukPelanggaranController::class, 'index'])->name('bentuk-pelanggaran.index'); // List bentuk pelanggaran

/*
    |--------------------------------------------------------------------------
    | Menu Sanksi Pelanggaran
    |--------------------------------------------------------------------------
    */
    Route::get('/sanksi-pelanggaran', [SanksiPelanggaranController::class, 'index'])->name('sanksi-pelanggaran.index'); // List sanksi pelanggaran

    /*
    |--------------------------------------------------------------------------
    | Menu Kategori Kepatuhan
    |--------------------------------------------------------------------------
    */
    Route::get('/kategori-kepatuhan', [KategoriKepatuhanController::class, 'index'])->name('kategori-kepatuhan.index'); // List kategori kepatuhan

    /*
    |--------------------------------------------------------------------------
    | Menu Bentuk Kepatuhan
    |--------------------------------------------------------------------------
    */
    Route::get('/bentuk-kepatuhan', [BentukKepatuhanController::class, 'index'])->name('bentuk-kepatuhan.index'); // List bentuk kepatuhan

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout user
});
