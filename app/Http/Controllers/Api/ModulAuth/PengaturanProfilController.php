<?php

namespace App\Http\Controllers\Api\ModulAuth;

use App\Models\Penduduk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengaturanProfilController extends Controller
{
    public function ambilDataProfil($nik){
        $data = Penduduk::where('nik',$nik)->first();

        return response()->json([
            'code' => 1,
            'message' => "Data Berhasil di Ambil",
            'data' => $data
        ]);
    }

    public function perbaharuiDataProfil(Request $request){
        $perbaharui = Penduduk::where('nik', $request->nik)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'golongan_darah' => $request->golongan_darah,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
        ]);

        if($perbaharui){
            $code = 1;
            $message = "Profil Berhasil di Perbaharui";
        }else{
            $code = 0;
            $message = "Profil Gagal di Perbaharui";
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }

    public function ubahPassword(Request $request){
        $nik = $request->nik;
        $password_lama = $request->password_lama;
        $password_baru = $request->password_baru;

        $data = Penduduk::where('nik',$nik)->first();

        if(!Hash::check($password_lama, $data->password)){
            $code = 0;
            $message = "Password Lama tidak sesuai";
        }else if($password_lama == $password_baru){
            $code = 0;
            $message = "Password Baru tidak boleh sama dengan yang sebelumnya";
        }else{
            $perbaharui = Penduduk::where('nik', $nik)->update([
                'password' => bcrypt($request->password_baru),
            ]);

            if($perbaharui){
                $code = 1;
                $message = "Password berhasil diperbaharui";
            }else{
                $code = 1;
                $message = "Password gagal diperbaharui";
            }
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => null
        ]);
    }
}
