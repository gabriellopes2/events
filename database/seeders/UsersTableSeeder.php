<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Gabriel Lopes',
            'username' => 'gabriel_lopes',
            'password' => Hash::make('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'Gustavo Adolfo',
            'username' => 'gustavo_adolfo',
            'password' => Hash::make('1234'),
        ]);
    }
}
