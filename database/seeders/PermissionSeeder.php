<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'anggota']);

        $anggota = Permission::create([
            'name' => 'create'
        ]);

        $anggota = Permission::create([
            'name' => 'update'
        ]);

        $anggota = Permission::create([
            'name' => 'read'
        ]);

        $anggota = Permission::create([
            'name' => 'delete'
        ]);
    }
}
