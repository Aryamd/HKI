<?php

namespace Database\Seeders;

use App\Models\JenisPaten;
use App\Models\StatusPaten;
use Illuminate\Database\Seeder;

class JenisAndStatusPatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPaten::create(['nama' => 'Paten']);
        JenisPaten::create(['nama' => 'Paten Sederhana']);

        StatusPaten::create(['nama' => 'Pengajuan Awal']);
        StatusPaten::create(['nama' => 'Terdaftar']);
        StatusPaten::create(['nama' => 'Kelengkapan Dokumen']);
        StatusPaten::create(['nama' => 'Mediasi']);
        StatusPaten::create(['nama' => 'Granted']);
    }
}
