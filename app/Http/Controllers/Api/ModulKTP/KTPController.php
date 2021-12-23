<?php

namespace App\Http\Controllers\Api\ModulKTP;

use Illuminate\Support\Facades\DB;
use App\Models\KTP;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KTPController extends Controller
{
    public function buatPengajuanBaru(Request $request){
        $newKTP = new KTP;
        $newKTP->jenis_pengajuan = $request->jenis_pengajuan;
        $newKTP->tanggal_pengajuan = now();
        $newKTP->status_pengajuan = "Menunggu Konfirmasi";
        $newKTP->nik = $request->nik;
        $newKTP->nama_lengkap = $request->nama;
        $newKTP->tempat_lahir = $request->tempat_lahir;
        $newKTP->tanggal_lahir = $request->tanggal_lahir;
        $newKTP->jenis_kelamin = $request->jenis_kelamin;
        $newKTP->golongan_darah = $request->golongan_darah;
        $newKTP->alamat = $request->alamat;
        $newKTP->agama = $request->agama;
        $newKTP->status_perkawinan = $request->status_perkawinan;
        $newKTP->pekerjaan = $request->pekerjaan;
        $newKTP->created_at = now();
        $newKTP->updated_at = now();
        $newKTP->save();

        if($newKTP){
            $code = 1;
            $message = "Pengajuan {$request->jenis_pengajuan} Berhasil";
        }else{
            $code = 0;
            $message = "Pengajuan Gagal";
        }

        return response()->json([
            'code' => $code,
            'message' => $message
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
            'message' => $message
        ]);
    }

    public function getPengajuanFor(Request $request){
        $pengajuan = KTP::where('nik', $request->nik)->get();
        if(!$pengajuan){
            $code = 0;
            $message = "Tidak Ada Data Pengajuan Sebelumnya";
        }else{
            $code = 1;
            $message = "";
        }

        return response()->json([
            'code' => $request->nik,
            'message' => $message,
            'data' => $pengajuan
        ]);
    }

    public function deletePengajuan(Request $request){
        $deletePenduduk = KTP::where('id', $request->id)->delete();

        if(!$deletePenduduk){
            $code = 0;
            $message = "Pengajuan gagal di hapus";
        }else{
            $code = 1;
            $message = "Pengajuan berhasil di hapus";
        }

        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }
}