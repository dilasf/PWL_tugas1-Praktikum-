<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'Sifa',
            'name' => 'Sifa Fadilah',
            'email' => 'sifafadilah339@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
