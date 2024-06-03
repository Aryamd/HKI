<?php

namespace Database\Seeders;

use App\Models\JenisMerek;
use Illuminate\Database\Seeder;

class JenisMerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisMerek::create(['nama' => 'Merek Dagang']);
        JenisMerek::create(['nama' => 'Merek Jasa']);
    }
}
