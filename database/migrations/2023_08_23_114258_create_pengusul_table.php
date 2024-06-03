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
        Schema::create('pengusul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hak_cipta_id')->nullable();
            $table->foreignId('paten_id')->nullable();
            $table->foreignId('merek_id')->nullable();
            $table->foreignId('desain_industri_id')->nullable();
            $table->foreignId('dtlst_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('nrp')->nullable();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('hp')->nullable();
            $table->boolean('is_ketua')->nullable();
            $table->boolean('is_doskar')->nullable();
            $table->boolean('is_mahasiswa')->nullable();
            $table->boolean('is_eksternal')->nullable();
            $table->foreignId('doskar_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->unsignedInteger('urutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengusul');
    }
};
