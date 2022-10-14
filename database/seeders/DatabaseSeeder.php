<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // command - php artisan migrate:fresh --seed
        $this->call([
            AutoSeeder::class,
            DriverSeeder::class,
            RelationSeeder::class
        ]);
    }
}
