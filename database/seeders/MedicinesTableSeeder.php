<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('medicines')->insert([
            [
                'name' => 'napa',
                'date' => '2025-10-25',
                'detail' => 'for fever',
                'selled' => 0,
                'quantity' => 100,
            ],
            [
                'name' => 'napaextra',
                'date' => '2025-10-25',
                'detail' => 'for fever',
                'selled' => 0,
                'quantity' => 100,
            ],
            [
                'name' => 'napaextend',
                'date' => '2025-10-25',
                'detail' => 'for fever',
                'selled' => 0,
                'quantity' => 100,
            ],
            [
                'name' => 'maxpro',
                'date' => '2025-10-25',
                'detail' => 'for gastrict',
                'selled' => 0,
                'quantity' => 100,
            ],
        ]);
    }
}
