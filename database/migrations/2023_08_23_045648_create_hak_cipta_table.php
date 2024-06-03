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
        Schema::create('hak_cipta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_hak_cipta_id')->nullable();
            $table->foreignId('sub_jenis_hak_cipta_id')->nullable();
            $table->string('judul')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('uraian')->nullable();
            $table->foreignId('negara_id')->nullable();
            $table->foreignId('kota_id')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->string('file_permohonan')->nullable();
            $table->string('file_pengalihan')->nullable();
            $table->string('file_pernyataan')->nullable();
            $table->string('file_ktp')->nullable();
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
        Schema::dropIfExists('hak_cipta');
    }
};
