<?php

namespace Database\Seeders;

use App\Models\{IpAddress, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        IpAddress::factory(100)->create();
    }
}
