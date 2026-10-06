<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Development only. Demo data seeders are added in Part 3.
        $this->call(AdminSeeder::class);
    }
}
