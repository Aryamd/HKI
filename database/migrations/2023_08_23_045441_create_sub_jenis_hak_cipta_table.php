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
        Schema::create('sub_jenis_hak_cipta', function (Blueprint $table) {
            $table->id();
            // $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->foreignId('jenis_hak_cipta_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_jenis_hak_cipta');
    }
};
