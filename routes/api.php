<?php

use App\Http\Controllers\Api\ModulAuth\LoginController;
use App\Http\Controllers\Api\ModulAuth\PengaturanProfilController;

use App\Http\Controllers\Api\ModulKTP\KTPController;

use App\Http\Controllers\Api\ModulPenduduk\PendudukController;

use App\Http\Controllers\Api\ModulVaksin\VaksinController;

use App\Http\Controllers\Api\ModulSurat\SuratController;

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
Route::get('/penduduk/getPengajuanFor/{nik}', [KTPController::class, 'pendudukGetPengajuanFor'])->name('ktp.getpengajuan');
Route::post('/penduduk/pengajuanKTP', [KTPController::class, 'pendudukBuatPengajuanBaru'])->name('ktp.pengajuan');
Route::get('/penduduk/deletePengajuan/{id}', [KTPController::class, 'pendudukDeletePengajuan'])->name('ktp.delete');

Route::post('/pegawai/updatePengajuan', [KTPController::class, 'pegawaiUpdatePengajuan'])->name('ktp.update');
Route::get('/pegawai/allPengajuan', [KTPController::class, 'pegawaiAllPengajuan'])->name('ktp.all');
Route::get('/pegawai/searchPengajuan/{key}', [KTPController::class, 'pegawaiSearchPengajuan'])->name('ktp.search');

Route::get('/detailPengajuan/{id}', [KTPController::class, 'detailPengajuan'])->name('ktp.detail');

//Route Modul Penduduk
Route::get('/getPenduduk', [PendudukController::class, 'getPenduduk'])->name('penduduk.read');
Route::post('/addPenduduk', [PendudukController::class, 'addPenduduk'])->name('penduduk.add');
Route::get('/editPenduduk/{nik}', [PendudukController::class, 'editPenduduk'])->name('penduduk.edit');
Route::post('/updatePenduduk', [PendudukController::class, 'updatePenduduk'])->name('penduduk.update');
Route::get('/resetPasswordPenduduk/{nik}', [PendudukController::class, 'resetPasswordPenduduk'])->name('penduduk.resetPassword');
Route::get('/deletePenduduk/{nik}', [PendudukController::class, 'deletePenduduk'])->name('penduduk.delete');
Route::get('/searchPenduduk/{key}', [PendudukController::class, 'searchPenduduk'])->name('penduduk.delete');

//Route Modul Vaksin
Route::post('/penduduk/tambahVaksin', [VaksinController::class, 'pendudukTambahVaksin'])->name('vaksin.insert');
Route::get('/penduduk/daftarVaksin/{nik}', [VaksinController::class, 'pendudukDaftarVaksin'])->name('vaksin.read');
Route::get('/penduduk/deleteVaksin/{id}', [VaksinController::class, 'pendudukDeleteVaksin'])->name('vaksin.delete');

Route::post('/pegawai/updateVaksin', [VaksinController::class, 'pegawaiUpdateVaksin'])->name('vaksin.update');
Route::get('/pegawai/daftarVaksinPegawai', [VaksinController::class, 'pegawaiDaftarVaksin'])->name('pvkasin.read');
Route::get('/pegawai/searchVaksin{key}', [VaksinController::class, 'pegawaiSearchVaksin'])->name('vaksin.searh');

Route::get('/detailDataVaksin/{id}', [VaksinController::class, 'detailVaksin'])->name('vaksin.detail');

//Route Modul Surat
Route::post('/penduduk/tambahSurat', [SuratController::class, 'pendudukTambahSurat'])->name('surat.insert');
Route::get('/penduduk/daftarSurat/{nik}', [SuratController::class, 'pendudukDaftarSurat'])->name('surat.read');
Route::get('/penduduk/deleteSurat/{id}', [SuratController::class, 'pendudukDeleteSurat'])->name('surat.delete');

Route::post('/pegawai/updateSurat', [SuratController::class, 'pegawaiUpdateSurat'])->name('surat.update');
Route::get('/pegawai/daftarSuratPegawai', [SuratController::class, 'pegawaiDaftarSurat'])->name('psurat.read');
Route::get('/pegawai/searchSurat{key}', [SuratController::class, 'pegawaiSearchSurat'])->name('surat.searh');

Route::get('/detailDataSurat/{id}', [SuratController::class, 'detailSurat'])->name('surat.detail');

Route::post('/testFileUpload', [SuratController::class, 'uploadFile']);
