<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenduduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penduduk', function (Blueprint $table) {
            $table->bigInteger('nik')->primary();
            $table->string('password', 200);
            $table->enum('status_akses', ['Admin', 'Pegawai', 'Penduduk']);
            $table->string('nama_lengkap', 50);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki - Laki', 'Perempuan']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->string('alamat', 100);
            $table->enum('agama', ['Hindu', 'Islam','Kristen Katolik','Kristen Protestan','Budha','Kong Hu Chu']);
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('pekerjaan', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penduduk');
    }
}
