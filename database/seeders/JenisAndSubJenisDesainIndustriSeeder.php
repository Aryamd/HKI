<?php

namespace Database\Seeders;

use App\Models\JenisDesainIndustri;
use App\Models\SubJenisDesainIndustri;
use Illuminate\Database\Seeder;

class JenisAndSubJenisDesainIndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $di1 = JenisDesainIndustri::create(['nama' => 'Satu Desain']);
        SubJenisDesainIndustri::create(['nama' => '-', 'jenis_desain_industri_id' => $di1->id]);

        $di2 = JenisDesainIndustri::create(['nama' => 'Pecahan Satu Desain']);
        SubJenisDesainIndustri::create(['nama' => '-', 'jenis_desain_industri_id' => $di2->id]);

        $di3 = JenisDesainIndustri::create(['nama' => 'Satu Kesatuan Desain (Set)']);
        SubJenisDesainIndustri::create(['nama' => '-', 'jenis_desain_industri_id' => $di3->id]);

        $di4 = JenisDesainIndustri::create(['nama' => 'Pecahan Satu Kesatuan Desain (Set)']);
        SubJenisDesainIndustri::create(['nama' => '-', 'jenis_desain_industri_id' => $di4->id]);
    }
}
