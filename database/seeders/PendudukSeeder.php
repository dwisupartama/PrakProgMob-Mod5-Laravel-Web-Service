<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penduduk::create([
            'nik' => 001,
            'password' => bcrypt('Admin123'),
            'status_akses' => 'Admin',
            'nama_lengkap' => 'Admin Ganteng',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2000/02/02',
            'jenis_kelamin' => 'Laki - Laki',
            'golongan_darah' => 'A',
            'alamat' => 'Tidak Terlihat',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Pelajar/Mahasiswa',
        ]);

        Penduduk::create([
            'nik' => 002,
            'password' => bcrypt('Pegawai123'),
            'status_akses' => 'Pegawai',
            'nama_lengkap' => 'Pegawai Cantik',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2000/02/02',
            'jenis_kelamin' => 'Perempuan',
            'golongan_darah' => 'B',
            'alamat' => 'Tidak Terlihat',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Pelajar/Mahasiswa',
        ]);
        
        Penduduk::create([
            'nik' => 003,
            'password' => bcrypt('Penduduk123'),
            'status_akses' => 'Penduduk',
            'nama_lengkap' => 'Penduduk Aja',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2000/02/02',
            'jenis_kelamin' => 'Laki - Laki',
            'golongan_darah' => 'O',
            'alamat' => 'Tidak Terlihat',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Pelajar/Mahasiswa',
        ]);
    }
}
