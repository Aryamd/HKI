<?php

namespace Database\Seeders;

use App\Models\Negara;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Negara::create(['id' => 1, 'nama' => 'INDONESIA']);

        $path = 'database/seeders/wilayah.sql';
        DB::unprepared(file_get_contents($path));


    }
}
