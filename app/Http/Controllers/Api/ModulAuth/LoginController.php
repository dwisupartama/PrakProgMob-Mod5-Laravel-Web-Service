<?php

namespace App\Http\Controllers\Api\ModulAuth;

use App\Models\Penduduk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginPenduduk(Request $request){
        $nik = $request->nik;
        $password = $request->password;

        $penduduk = Penduduk::where('nik', $nik)->first();
        if(!$penduduk){
            $code = 0;
            $message = "Akun tidak terdaftar";
        }else{
            if(!Hash::check($password, $penduduk->password)){
                $code = 0;
                $message = "Password Salah";
            }else{
                $code = 1;
                $message = "Berhasil Login";
            }
        }

        if($code == 0){
            $penduduk = null;
        }

        //Code 0 : Warning
        //Code 1 : Success
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $penduduk
        ]);
    }

    public function loginPegawai(Request $request){
        $nik = $request->nik;
        $password = $request->password;

        $penduduk = Penduduk::where([['nik','=',$nik],['status_akses','<>', 'Penduduk']])->first();
        if(!$penduduk){
            $code = 0;
            $message = "Akun tidak terdaftar";
        }else{
            if(!Hash::check($password, $penduduk->password)){
                $code = 0;
                $message = "Password Salah";
            }else{
                $code = 1;
                $message = "Berhasil Login";
            }
        }

        if($code == 0){
            $penduduk = null;
        }

        //Code 0 : Warning
        //Code 1 : Success
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $penduduk
        ]);
    }
}
