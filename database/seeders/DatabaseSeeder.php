<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PostCatalogue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UserRoleSeeder::class,
            //UserReferralSeeder::class,
            CenterSeeder::class,
            ReferralStatusSeeder::class,
            PostCatalogueSeeder::class,
        ]);
    }
}
