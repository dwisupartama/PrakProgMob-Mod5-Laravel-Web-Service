<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKtp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ktp', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_pengajuan', ['Pembuatan KTP', 'KTP Rusak/Hilang', 'KTP Perbaikan']);
            $table->date('tanggal_pengajuan');
            $table->enum('status_pengajuan', ['Menunggu Konfirmasi', 'Sedang di Proses', 'Selesai di Proses', 'Pengajuan Gagal']);
            $table->text('keterangan')->nullable();
            $table->date('perkiraan_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->bigInteger('nik');
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

            // Foreign Key
            $table->foreign('nik')->references('nik')->on('tb_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_ktp');
    }
}
