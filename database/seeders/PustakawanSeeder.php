<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
// use App\Models\Role;
//use App\Models\Permission;


class PustakawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $user = Role::create([
            'name' => 'pustakawan'
        ]);

        $anggota = Role::create([
            'name' => 'anggota'
        ]);
        $permission = Permission::create([
            'name' => 'create'
        ]);
        $permission = Permission::create([
            'name' => 'update'
        ]);
        $permission = Permission::create([
            'name' => 'read'
        ]);
        $permission = Permission::create([
            'name' => 'delete'
        ]);
        $user = User::create([
            'name' => 'Pustakawan',
            'email' => 'pustakawan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole('pustakawan');

        $anggota = User::create([
            'name' => 'Anggota1',
            'email' => 'anggota1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $anggota->assignRole('anggota');

        // $role_admin->givePermissionTo('read');
    //     // $role_admin->givePermissionTo('update');
    //     // $role_admin->givePermissionTo('delete');
    //     // $role_admin->givePermissionTo('create');
    //     // $role_anggota->givePermissionTo('read');

    }
}
