<?php

namespace Database\Seeders;

use App\Models\Doskar;
use App\Models\Mahasiswa;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        // Role
        $adminRole = Role::create(['id' => 1, 'name' => 'Admin']);

        $kadepRole = Role::create(['id' => 4, 'name'=> 'Kadep']);
        $kaprodiRole = Role::create(['id' => 5, 'name' => 'Kaprodi']);

        $dosenRole = Role::create(['id' => 11, 'name' => 'Dosen']);

        // Role to Permission
        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
        ]);

        // Doskar
        $adminDoskar = Doskar::create([
            'nip' => '0000000000000000',
            'nama' => 'Admin',
            'email' => 'admin@pnb.ac.id',
            'hp' => '000000000000'
        ]);
        $kadepDoskar = Doskar::create([
            'nip' => '0000000000000000',
            'nama' => 'Kepala Departemen',
            'email' => 'kadep@pnb.ac.id',
            'hp' => '000000000000'
        ]);
        $kaprodiDoskar = Doskar::create([
            'nip' => '0000000000000000',
            'nama' => 'Kepala Program Studi',
            'email' => 'kaprodi@pnb.ac.id',
            'hp' => '000000000000'
        ]);

        // User
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@pnb.ac.id',
            'username' => 'admin',
            'password' => 'admin',
            'doskar_id' => $adminDoskar->id,
        ]);
        $adminUser->assignRole('Admin');

        $kadepUser = User::create([
            'name' => 'Kepala Departemen',
            'email' => 'kadep@pnb.ac.id',
            'username' => 'kadep',
            'password' => 'kadep',
            'doskar_id' => $kadepDoskar->id,
        ]);
        $kadepUser->assignRole('Kadep');

        $kaprodiUser = User::create([
            'name' => 'Kepala Program Studi',
            'email' => 'kaprodi@pnb.ac.id',
            'username' => 'kaprodi',
            'password' => 'kaprodi',
            'doskar_id' => $kaprodiDoskar->id,
        ]);
        $kaprodiUser->assignRole('Kaprodi');


        // // Mahasiswa
        // Mahasiswa::create([
        //     'nrp' => '3515873523656',
        //     'nama' => 'Mahasiswa A',
        //     'email' => 'ma@gmail.com',
        //     'hp' => '0815254635247'
        // ]);
        // Mahasiswa::create([
        //     'nrp' => '725827632589',
        //     'nama' => 'Mahasiswa B',
        //     'email' => 'mb@gmail.com',
        //     'hp' => '0859364752'
        // ]);

        // $dosen = User::create([
        //     'name' => 'Dosen',
        //     'email' => 'dosen.sentra.hki@pens.ac.id',
        //     'username' => 'dosen',
        //     'password' => 'dosen',
        //     'doskar_id' => $doskar->id
        // ]);
        // $dosen->assignRole('Dosen');

    }
}
