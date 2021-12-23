<?php

namespace App\Http\Controllers\Api\ModulPenduduk;

use App\Models\Penduduk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function getPenduduk(){
        $penduduk = Penduduk::orderBy('created_at','desc')->get();

        return response()->json([
            'code' => 1,
            'message' => "Data Penduduk berhasil diambil",
            'data' => $penduduk
        ]);
    }

    public function addPenduduk(Request $request){
        $nik = $request->nik;
        $status_akses = $request->status_akses;
        $nama_lengkap = $request->nama_lengkap;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $jenis_kelamin = $request->jenis_kelamin;
        $golongan_darah = $request->golongan_darah;
        $alamat = $request->alamat;
        $agama = $request->agama;
        $status_perkawinan = $request->status_perkawinan;
        $pekerjaan = $request->pekerjaan;

        $checkNIK = Penduduk::where('nik',$nik)->count();

        if($checkNIK > 0){
            $code = 0;
            $message = "NIK tidak dapat digunakan karena sudah terdaftar";
        }else{
            $password = bcrypt($nik);
            $addPenduduk = Penduduk::insert([
                'nik' => $nik,
                'password' => $password,
                'status_akses' => $status_akses,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'golongan_darah' => $golongan_darah,
                'alamat' => $alamat,
                'agama' => $agama,
                'status_perkawinan' => $status_perkawinan,
                'pekerjaan' => $pekerjaan,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if(!$addPenduduk){
                $code = 0;
                $message = "Penduduk gagal didaftarkan, mohon cek formulir";
            }else{
                $code = 1;
                $message = "Penduduk berhasil didaftarkan";
            }
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function editPenduduk($nik){
        $getPenduduk = Penduduk::where('nik',$nik)->first();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $getPenduduk
        ]);
    }

    public function updatePenduduk(Request $request){
        $nik = $request->nik;
        $status_akses = $request->status_akses;
        $new_nik = $request->new_nik;
        $nama_lengkap = $request->nama_lengkap;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $jenis_kelamin = $request->jenis_kelamin;
        $golongan_darah = $request->golongan_darah;
        $alamat = $request->alamat;
        $agama = $request->agama;
        $status_perkawinan = $request->status_perkawinan;
        $pekerjaan = $request->pekerjaan;

        $checkNIK = Penduduk::where('nik','!=',$nik)->where('nik', $new_nik)->count();

        if($checkNIK > 0){
            $code = 0;
            $message = "NIK pembaharuan tidak dapat digunakan";
        }else{
            $updatePenduduk = Penduduk::where('nik', $nik)->update([
                'nik' => $new_nik,
                'status_akses' => $status_akses,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'golongan_darah' => $golongan_darah,
                'alamat' => $alamat,
                'agama' => $agama,
                'status_perkawinan' => $status_perkawinan,
                'pekerjaan' => $pekerjaan,
                'updated_at' => now()
            ]);

            if(!$updatePenduduk){
                $code = 0;
                $message = "Penduduk gagal diperbaharui, mohon cek formulir";
            }else{
                $code = 1;
                $message = "Penduduk berhasil diperbaharui";
            }
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function resetPasswordPenduduk($nik){
        $resetPasswordPenduduk = Penduduk::where('nik', $nik)->update([
            'password' => bcrypt($nik)
        ]);

        if(!$resetPasswordPenduduk){
            $code = 0;
            $message = "Password gagal di reset";
        }else{
            $code = 1;
            $message = "Password berhasil di reset";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function deletePenduduk($nik){
        $deletePenduduk = Penduduk::where('nik', $nik)->delete();

        if(!$deletePenduduk){
            $code = 0;
            $message = "Penduduk gagal di hapus";
        }else{
            $code = 1;
            $message = "Penduduk berhasil di hapus";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function searchPenduduk($key){
        $penduduk = Penduduk::where('nik','LIKE','%'.$key.'%')->orWhere('nama_lengkap','LIKE','%'.$key.'%')->orderBy('created_at','desc')->get();

        return response()->json([
            'code' => 1,
            'message' => "Data Penduduk berhasil diambil",
            'data' => $penduduk
        ]);
    }
}
