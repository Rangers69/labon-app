<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Konsumen;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $role = Role::create([
            'nama' => 'admin'
        ]);

        User::create(['name' => 'Owner',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
            'role_id' => $role->id
        ]);

        // karayawan
        $role = Role::create([
            'nama' => 'karyawan'
        ]);

        $user = User::create([
            'name' => 'karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => $role->id
        ]);
        
        Karyawan::create([
            'user_id' => $user->id,
            'hp' => '085123456789',
            'alamat' => 'jl. gajah'
        ]);

        // komsumen
        $role = Role::create([
            'nama' => 'konsumen'
        ]);

        $user = User::create([
            'name' => 'dede',
            'email' => 'frianzynow@gmail.com',
            'password' => bcrypt('123123123'),
            'role_id' => $role->id
        ]);

        Konsumen::create([
            'user_id' => $user->id,
            'hp' => '085123456789',
            'alamat' => 'jl. gajah'
        ]);
    }
}
