<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_paten_id')->nullable();
            $table->foreignId('status_paten_id')->nullable();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('abstrak')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('file_pernyataan_kebaruan')->nullable();
            $table->string('file_permohonan_paten')->nullable();
            $table->string('file_pemeriksaan_substantif')->nullable();
            $table->string('file_deskripsi_paten')->nullable();
            $table->string('file_klaim')->nullable();
            $table->string('file_gambar_teknik')->nullable();
            $table->string('file_abstrak')->nullable();
            $table->string('file_penyerahan_hak')->nullable();
            $table->string('file_kepemilikan_inventor')->nullable();
            $table->string('file_surat_pengalihan_hak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paten');
    }
};
