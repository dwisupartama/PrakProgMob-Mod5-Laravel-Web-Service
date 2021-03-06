<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('jenis_surat', 30);
            $table->date('tanggal_pengajuan');
            $table->enum('status_pengajuan', ['Menunggu Konfirmasi', 'Sedang di Proses', 'Selesai di Proses', 'Pengajuan Gagal']);
            $table->text('keterangan')->nullable();
            $table->date('perkiraan_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('deskripsi_pengajuan');
            $table->string('file_surat', 200)->nullable();
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
        Schema::dropIfExists('tb_surat');
    }
}
