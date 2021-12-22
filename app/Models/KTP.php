<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KTP extends Model
{
    use HasFactory;

    protected $guarded = ['id','jenis_pengajuan','tanggal_pengajuan','status_pengajuan','keterangan','perkiraan_selesai','tanggal_selesai','nik','nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin','golongan_darah','alamat','agama','status_perkawinan','pekerjaan','created_at','updated_at'];
    protected $table = 'tb_ktp';
}
