<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create(['id' => 1, 'nama' => 'D3 Teknik Sipil']);
        Prodi::create(['id' => 2, 'nama' => 'D4 Manajemen Proyek Konstruksi']);
        Prodi::create(['id' => 3, 'nama' => 'S1 Terapan Teknologi Rekayasa Konstruksi Bangunan Gedung']);
        Prodi::create(['id' => 4, 'nama' => 'S1 Terapan Teknologi Rekayasa Konstruksi Bangunan Air']);
        Prodi::create(['id' => 5, 'nama' => 'D3 Manajemen Informatika']);
        Prodi::create(['id' => 6, 'nama' => 'D3 Teknik Listrik']);
        Prodi::create(['id' => 7, 'nama' => 'D4 Teknik Otomasi']);
        Prodi::create(['id' => 8, 'nama' => 'D4 Teknologi Rekayasa Perangkat Lunak']);
        Prodi::create(['id' => 9, 'nama' => 'D3 Teknik Mesin']);
        Prodi::create(['id' => 10, 'nama' => 'D3 Teknik Pendingin dan Tata Udara']);
        Prodi::create(['id' => 11, 'nama' => 'D2 Fastrak Teknik Mesin']);
        Prodi::create(['id' => 12, 'nama' => 'S1 Terapan Rekayasa Perancangan Mekanik']);
        Prodi::create(['id' => 13, 'nama' => 'S1 Terapan Teknologi Rekayasa Utilitas']);
        Prodi::create(['id' => 14, 'nama' => 'D4 Manajemen Bisnis Pariwisata']);
        Prodi::create(['id' => 15, 'nama' => 'D3 Perhotelan']);
        Prodi::create(['id' => 16, 'nama' => 'D3 Usaha Perjalanan Wisata']);
        Prodi::create(['id' => 17, 'nama' => 'S2 Perencanaan']);
        Prodi::create(['id' => 18, 'nama' => 'D3 Administrasi Bisnis']);
        Prodi::create(['id' => 19, 'nama' => 'D4 Manajemen Bisnis Internasional']);
        Prodi::create(['id' => 20, 'nama' => 'D3 Akuntansi']);
        Prodi::create(['id' => 21, 'nama' => 'D4 Akuntansi Manajerial']);
        Prodi::create(['id' => 22, 'nama' => 'D4 Akuntansi Perpajakan']);
    }
}
