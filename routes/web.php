<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\LaporanPengaduanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\VerifikasiPengaduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# ------ Unauthenticated routes ------ #
Route::get('/', [RouteController::class, 'landing']);
require __DIR__ . '/auth.php';


# ------ Authenticated routes ------ #
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [RouteController::class, 'dashboard'])->name('home'); # dashboard

    Route::middleware(['roles:admin'])->group(function () {
        Route::prefix('data')->name('datatable.')->group(function () {
            Route::get('/users', [DataTableController::class, 'getUsers'])->name('users');
        });

        Route::get('/datatable/users', [UserController::class, 'userDataTable'])->name('users.datatables');
        Route::resource('users', UserController::class);
        Route::resource('masyarakat', MasyarakatController::class);
        Route::resource('verifikasi-pengaduan', VerifikasiPengaduanController::class);
    });

    # ------ DataTables routes ------ #
    Route::post('/pengaduan/tanggapan/{pengaduanId}', [PengaduanController::class, 'storeTanggapan'])->name('pengaduan.store-tanggapan');
    Route::resource('pengaduan', PengaduanController::class);

    Route::get('/laporan-pengaduan/export-pdf/{request}', [LaporanPengaduanController::class, 'exportPdf'])->name('laporan-pengaduan.export');
    Route::resource('laporan-pengaduan', LaporanPengaduanController::class);
});
