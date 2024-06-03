<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoskarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = 'database/seeders/doskar.sql';
        DB::unprepared(file_get_contents($path));

        DB::table('doskar')->where('id', '>=', 11)->get()->each(function ($row) {
            $user = User::create([
                'name' => $row->nama,
                'email' => $row->nip.'@pnb.ac.id',
                'username' => $row->nip,
                'password' => $row->nip,
                'doskar_id' => $row->id,
            ]);
            $user->assignRole('Dosen');
        });

        Mahasiswa::create([
            'nrp' => '123456789',
            'nama' => 'Mahasiswa A',
            'email' => 'aa@gmail.com',
            'hp' => '0123456789'
        ]);
    }
}
