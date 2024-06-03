<?php

namespace Database\Seeders;

use App\Models\JenisDTLST;
use App\Models\SubJenisDTLST;
use Illuminate\Database\Seeder;

class JenisAndSubJenisDTLSTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dtlst1 = JenisDTLST::create(['nama' => 'Komputer']);
        SubJenisDTLST::create(['nama' => 'Mobile', 'jenis_dtlst_id' => $dtlst1->id]);
    }
}
