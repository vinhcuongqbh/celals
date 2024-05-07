<?php

namespace Database\Seeders;

use App\Models\UserReferral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userReferral = UserReferral::factory()->count(500)->create();
    }
}
