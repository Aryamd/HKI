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
        Schema::create('desain_industri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_desain_industri_id')->nullable();
            $table->foreignId('sub_jenis_desain_industri_id')->nullable();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('uraian')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('file_gambar_desain_industri')->nullable();
            $table->string('file_rincian_gambar_desain_industri')->nullable();
            $table->string('file_gambar_tampak_depan')->nullable();
            $table->string('file_gambar_tampak_belakang');
            $table->string('file_gambar_tampak_samping_kiri')->nullable();
            $table->string('file_gambar_tampak_samping_kanan')->nullable();
            $table->string('file_gambar_tampak_atas')->nullable();
            $table->string('file_uraian_desain_industri')->nullable();
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
        Schema::dropIfExists('desain_industri');
    }
};
