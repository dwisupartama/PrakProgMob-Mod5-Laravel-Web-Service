<?php

namespace App\Http\Controllers\Api\ModulVaksin;

use App\Http\Controllers\Controller;
use App\Models\Vaksin;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function daftarVaksin($nik){
        $data = Vaksin::where('nik',$nik)->get();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $data
        ]);
    }

    public function daftarVaksinPegawai(){
        $data = Vaksin::all();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $data
        ]);
    }

    public function detailVaksin($id){
        $data = Vaksin::where('id',$id)->first();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $data
        ]);
    }

    // public function updateVaksin(Request $request){}

    // public function hapusVaksin(Request $request){}


    public function tambahVaksin(Request $request){
        $tambah = Vaksin::insert([
            'nik' => $request->nik,
            'tahap_vaksin' => $request->tahap_vaksin,
            'tanggal_pengajuan' => now(),
            'status_pengajuan' => 'Menunggu Konfirmasi',
            'daerah_vaksin_diajukan' => $request->daerah_vaksin_diajukan,
            'riwayat_penyakit' => $request->riwayat_penyakit,
        ]);

        if($tambah){
            $code = 1;
            $message = "Pengajuan Vaksin Menunggu Konfirmasi";
        }else{
            $code = 0;
            $message = "Pengajuan Vaksin Gagal";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }
}
