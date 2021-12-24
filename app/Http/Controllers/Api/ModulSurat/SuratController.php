<?php

namespace App\Http\Controllers\Api\ModulSurat;

use App\Models\Surat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function pendudukTambahSurat(Request $request){
        $tambah = Surat::insert([
            'nik' => $request->nik,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_pengajuan' => now(),
            'status_pengajuan' => 'Menunggu Konfirmasi',
            'deskripsi_pengajuan' => $request->deskripsi_pengajuan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($tambah){
            $code = 1;
            $message = "Pengajuan Surat Menunggu Konfirmasi";
        }else{
            $code = 0;
            $message = "Pengajuan Surat Gagal";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function pendudukDaftarSurat($nik){
        $data = Surat::join('tb_penduduk', 'tb_surat.nik', '=', 'tb_penduduk.nik')->select('tb_surat.*', 'tb_penduduk.nama_lengkap')->where('tb_surat.nik',$nik)->orderBy('updated_at','desc')->get();

        if(!$data){
            $code = 0;
            $message = "Tidak Ada Data Surat Sebelumnya";
        }else{
            $code = 1;
            $message = "Data surat berhasil di ambil";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function pendudukDeleteSurat($id){
        $deleteSurat = Surat::where('id', $id)->delete();

        if(!$deleteSurat){
            $code = 0;
            $message = "Surat gagal di hapus";
        }else{
            $code = 1;
            $message = "Pengajuan surat berhasil di hapus";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function pegawaiUpdateSurat(Request $request){
        if($request->file){
            
            $file = base64_decode($request->file);

            $tujuan_upload = 'file_surat';
            $ekstensi = $file->getClientOriginalExtension();
            $id = $request->id;
            $customName = $id.".".$ekstensi;

            $file->move($tujuan_upload,$customName);

            $perbaharui = Surat::where('id', $request->id)->update([
                'status_pengajuan' => $request->status_pengajuan,
                'keterangan' => $request->keterangan,
                'perkiraan_selesai' => $request->perkiraan_selesai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'file_surat' => $customName,
                'updated_at' => now()
            ]);
        }else{
            $perbaharui = Surat::where('id', $request->id)->update([
                'status_pengajuan' => $request->status_pengajuan,
                'keterangan' => $request->keterangan,
                'perkiraan_selesai' => $request->perkiraan_selesai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'updated_at' => now()
            ]);
        }
        

        if($perbaharui){
            $code = 1;
            $message = "Pengajuan Surat dengan berhasil di perbaharui";
        }else{
            $code = 0;
            $message = "Pengajuan Surat Gagal di Perbaharui";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function pegawaiDaftarSurat(){
        $data = Surat::join('tb_penduduk', 'tb_surat.nik', '=', 'tb_penduduk.nik')->select('tb_surat.*', 'tb_penduduk.nama_lengkap')->orderBy('updated_at','desc')->get();

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

    public function pegawaiSearchSurat($key){
        $searchPengajuan = Surat::join('tb_penduduk', 'tb_surat.nik', '=', 'tb_penduduk.nik')->select('tb_surat.*', 'tb_penduduk.nama_lengkap')->where('jenis_surat','LIKE','%'.$key.'%')->orWhere('nama_lengkap','LIKE','%'.$key.'%')->orWhere('nik','LIKE','%'.$key.'%')->orWhere('status_pengajuan','LIKE','%'.$key.'%')->orderBy('updated_at','desc')->get();

        return response()->json([
            'code' => 1,
            'message' => "Data Pengajuan berhasil diambil",
            'data' => $searchPengajuan
        ]);
    }


    public function detailSurat($id){
        $data = Surat::where('id',$id)->first();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $data
        ]);
    }

    public function uploadFile(Request $request){
        $file = $request->file('file');

        $tujuan_upload = 'file_surat';
        $ekstensi = $file->getClientOriginalExtension();
        $customName = "Test";

        $file->move($tujuan_upload,$customName.".".$ekstensi);
        return "Berhasil";
    }
}
