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
        Schema::create('dtlst', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_dtlst_id')->nullable();
            $table->foreignId('sub_jenis_dtlst_id')->nullable();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('uraian')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('file_gambar_dtlst')->nullable();
            $table->string('file_uraian_dtlst')->nullable();
            $table->string('file_surat_pernyataan_kepemilikan')->nullable();
            $table->string('file_surat_pernyataan_pengalihan_hak')->nullable();
            $table->string('status')->nullable();
            $table->string('pesan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtlst');
    }
};
