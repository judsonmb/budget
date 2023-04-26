<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrowsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('browsers')->insert([
            [
                'id' => 1, 
                'name' => 'Chrome', 
            ],
            [
                'id' => 2, 
                'name' => 'Edge', 
            ],
            [
                'id' => 3, 
                'name' => 'Firefox', 
            ],
            [
                'id' => 4, 
                'name' => 'Safari', 
            ],
        ]);
    }
}
