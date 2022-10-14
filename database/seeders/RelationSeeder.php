<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relation')->insertOrIgnore([
            ['driver_id' => 1, 'auto_id' => 10],
            ['driver_id' => 2, 'auto_id' => 9],
            ['driver_id' => 3, 'auto_id' => 8],
            ['driver_id' => 4, 'auto_id' => 7],
            ['driver_id' => 5, 'auto_id' => 6],
        ]);
    }
}
