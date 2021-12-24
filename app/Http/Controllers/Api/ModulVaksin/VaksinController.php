<?php

namespace App\Http\Controllers\Api\ModulVaksin;

use App\Http\Controllers\Controller;
use App\Models\Vaksin;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function pendudukTambahVaksin(Request $request){
        $tambah = Vaksin::insert([
            'nik' => $request->nik,
            'tahap_vaksin' => $request->tahap_vaksin,
            'tanggal_pengajuan' => now(),
            'status_pengajuan' => 'Menunggu Konfirmasi',
            'daerah_vaksin_diajukan' => $request->daerah_vaksin_diajukan,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'created_at' => now(),
            'updated_at' => now()
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

    public function pendudukDaftarVaksin($nik){
        $data = Vaksin::join('tb_penduduk', 'tb_vaksin.nik', '=', 'tb_penduduk.nik')->select('tb_vaksin.*', 'tb_penduduk.nama_lengkap')->where('tb_vaksin.nik',$nik)->orderBy('updated_at','desc')->get();

        if(!$data){
            $code = 0;
            $message = "Tidak Ada Data Vaksin Sebelumnya";
        }else{
            $code = 1;
            $message = "Data vaksin berhasil di ambil";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function pendudukDeleteVaksin($id){
        $deleteVaksin = Vaksin::where('id', $id)->delete();

        if(!$deleteVaksin){
            $code = 0;
            $message = "Vaksin gagal di hapus";
        }else{
            $code = 1;
            $message = "Pengajuan vaksin berhasil di hapus";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function pegawaiUpdateVaksin(Request $request){
        $perbaharui = Vaksin::where('id', $request->id)->update([
            'status_pengajuan' => $request->status_pengajuan,
            'keterangan' => $request->keterangan,
            'perkiraan_selesai' => $request->perkiraan_selesai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tanggal_vaksin' => $request->tanggal_vaksin,
            'waktu_vaksin' => $request->waktu_vaksin,
            'tempat_vaksin' => $request->tempat_vaksin,
            'jenis_vaksin' => $request->jenis_vaksin,
            'updated_at' => now()
        ]);

        if($perbaharui){
            $code = 1;
            $message = "Pengajuan Vaksin dengan berhasil di perbaharui";
        }else{
            $code = 0;
            $message = "Pengajuan Vaksin Gagal di Perbaharui";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function pegawaiDaftarVaksin(){
        $data = Vaksin::join('tb_penduduk', 'tb_vaksin.nik', '=', 'tb_penduduk.nik')->select('tb_vaksin.*', 'tb_penduduk.nama_lengkap')->orderBy('updated_at','desc')->get();

        if($data){
            $code = 1;
            $message = "Data berhasil di ambil";
        }else{
            $code = 0;
            $message = "Data gagal di ambil";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function pegawaiSearchVaksin($key){
        $searchPengajuan = Vaksin::join('tb_penduduk', 'tb_vaksin.nik', '=', 'tb_penduduk.nik')->select('tb_vaksin.*', 'tb_penduduk.nama_lengkap')->where('tahap_vaksin','LIKE','%'.$key.'%')->orWhere('nama_lengkap','LIKE','%'.$key.'%')->orWhere('nik','LIKE','%'.$key.'%')->orWhere('status_pengajuan','LIKE','%'.$key.'%')->orderBy('updated_at','desc')->get();

        return response()->json([
            'code' => 1,
            'message' => "Data Pengajuan berhasil diambil",
            'data' => $searchPengajuan
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
    
}
