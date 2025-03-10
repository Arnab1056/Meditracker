<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Pharmacy',
                'email' => 'pharmacy@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medicine',
                'email' => 'medicine@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ]);
    }
}
