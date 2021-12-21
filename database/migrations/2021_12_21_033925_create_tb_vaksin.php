<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVaksin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vaksin', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->enum('tahap_vaksin', ['Vaksin Pertama', 'Vaksin Kedua']);
            $table->date('tanggal_pengajuan');
            $table->enum('status_pengajuan', ['Menunggu Konfirmasi', 'Sedang di Proses', 'Selesai di Proses', 'Pengajuan Gagal']);
            $table->text('keterangan');
            $table->date('perkiraan_selesai');
            $table->date('tanggal_selesai');
            $table->date('tanggal_vaksin');
            $table->string('waktu_vaksin', 50);
            $table->string('tempat_vaksin', 100);
            $table->string('jenis_vaksin', 50);
            $table->string('daerah_vaksin_diajukan', 30);
            $table->text('riwayat_penyakit');
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
        Schema::dropIfExists('tb_vaksin');
    }
}
