<?php

namespace App\Http\Controllers\Api\ModulKTP;

use App\Models\KTP;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengaturanProfilController extends Controller
{
    public function buatPengajuanBaru(Request $request){
        KTP::new()->insertGetId([
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status_pengajuan' => "Menunggu Konfirmasi",
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'golongan_darah' => $request->golongan_darah,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    public function updatePengajuan(Request $request){
        $perbaharui = KTP::where('id', $request->id)->update([
            'status_pengajuan' => $request->status_pengajuan,
            'keterangan' => $request->keterangan,
            'perkiraan_selesai' => $request->perkiraan_selesai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'updated_at' => now()
        ]);

        if($perbaharui){
            $code = 1;
            $message = "Pengajuan KTP dengan id $request->id Berhasil di Perbaharui";
        }else{
            $code = 0;
            $message = "Pengajuan Gagal di Perbaharui";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    
}
