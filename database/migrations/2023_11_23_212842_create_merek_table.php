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
        Schema::create('merek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_merek_id')->nullable();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('uraian')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('file_uraian_merek')->nullable();
            $table->string('file_ttd_pemohon')->nullable();
            $table->string('file_gambar')->nullable();
            $table->string('file_pernyataan_lisensi')->nullable();
            $table->string('file_permohonan_merek')->nullable();
            $table->string('file_perpanjangan_merek')->nullable();
            $table->string('file_surat_pengalihan_hak')->nullable();
            $table->string('file_surat_perubahan_nama_alamat')->nullable();
            $table->string('file_penjelasan_pendaftaran_merek')->nullable();
            $table->string('file_penjelasan_perpanjangan_merek')->nullable();
            $table->string('file_penjelasan_pengalihan_hak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merek');
    }
};
