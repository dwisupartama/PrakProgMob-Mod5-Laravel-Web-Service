<?php

use App\Http\Controllers\Api\ModulAuth\LoginController;
use App\Http\Controllers\Api\ModulAuth\PengaturanProfilController;

use App\Http\Controllers\Api\ModulKTP\KTPController;

use App\Http\Controllers\Api\ModulPenduduk\PendudukController;
use App\Http\Controllers\Api\ModulVaksin\VaksinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route Modul Auth
Route::post('/loginPenduduk', [LoginController::class, 'loginPenduduk'])->name('login.penduduk');
Route::post('/loginPegawai', [LoginController::class, 'loginPegawai'])->name('login.pegawai');
Route::get('/ambilDataProfil/{nik}', [PengaturanProfilController::class, 'ambilDataProfil'])->name('profil.read');
Route::post('/perbaharuiProfil', [PengaturanProfilController::class, 'perbaharuiDataProfil'])->name('profil.update');
Route::post('/ubahPassword', [PengaturanProfilController::class, 'ubahPassword'])->name('profil.passupdate');

//Route Modul KTP
Route::post('/pengajuanKTP', [KTPController::class, 'buatPengajuanBaru'])->name('ktp.pengajuan');
Route::get('/getPengajuanFor/{nik}', [KTPController::class, 'getPengajuanFor'])->name('ktp.getpengajuan');
Route::post('/updatePengajuan', [KTPController::class, 'updatePengajuan'])->name('ktp.update');
Route::get('/deletePengajuan/{id}', [KTPController::class, 'deletePengajuan'])->name('ktp.delete');

//Route Modul Penduduk
Route::get('/getPenduduk', [PendudukController::class, 'getPenduduk'])->name('penduduk.read');
Route::post('/addPenduduk', [PendudukController::class, 'addPenduduk'])->name('penduduk.add');
Route::get('/editPenduduk/{nik}', [PendudukController::class, 'editPenduduk'])->name('penduduk.edit');
Route::post('/updatePenduduk', [PendudukController::class, 'updatePenduduk'])->name('penduduk.update');
Route::get('/resetPasswordPenduduk/{nik}', [PendudukController::class, 'resetPasswordPenduduk'])->name('penduduk.resetPassword');
Route::get('/deletePenduduk/{nik}', [PendudukController::class, 'deletePenduduk'])->name('penduduk.delete');
<<<<<<< HEAD
Route::get('/searchPenduduk/{key}', [PendudukController::class, 'searchPenduduk'])->name('penduduk.search');
=======

//Route Modul Vaksin
Route::post('/tambahVaksin', [VaksinController::class, 'tambahVaksin'])->name('vaksin.insert');
Route::get('/daftarVaksin/{nik}', [VaksinController::class, 'daftarVaksin'])->name('vaksin.read');
Route::get('/detailDataVaksin/{id}', [VaksinController::class, 'detailVaksin'])->name('vaksin.detail');
Route::get('/daftarVaksinPegawai', [VaksinController::class, 'daftarVaksinPegawai'])->name('vaksin.read');
// Route::post('/hapusVaksin', [VaksinController::class, 'hapusVaksin'])->name('vaksin.delete');
// Route::post('/updateVaksin', [VaksinController::class, 'updateVaksin'])->name('vaksin.update');
>>>>>>> a93407f09b07468010fcbdd05a351ec683708ed4
