<?php

use App\Http\Controllers\Api\ModulAuth\LoginController;
use App\Http\Controllers\Api\ModulAuth\PengaturanProfilController;
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