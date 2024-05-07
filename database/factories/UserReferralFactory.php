<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserReferral>
 */
class UserReferralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(2,7),
            'parent_name' => fake()->name(),
            'child_age' => rand(5,15),
            'email' => fake()->unique()->safeEmail(),
            'tel' => "09".rand(10000000,99999999),
            'center_id' => rand(1,2),
            'ref_status_id' => rand(1,4),
            'created_at' => Carbon::today()->subDays(rand(0, 90))
        ];
    }
}
