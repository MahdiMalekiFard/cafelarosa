<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            PageSeeder::class,
            SliderSeeder::class,
            OpinionSeeder::class,
            PortfolioSeeder::class,
            BlogSeeder::class,
            MenuSeeder::class,
            //            TagSeeder::class,
            //            CategorySeeder::class,
            //            BlogSeeder::class,
        ]);
        Artisan::call('passport:client', [
            '--personal'       => true,
            '--password'       => true,
            '--no-interaction' => true,
            '--provider'       => 'users',
            '--name'           => 'Laravel Password Grant Client',
        ]);
    }
}
