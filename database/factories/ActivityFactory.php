<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'app_user_id'=>fake()->numberBetween(1, AppUser::get()->count()),
            'body'=>fake()->paragraph(),
            'like_count'=>fake()->numberBetween(),
            'dislike_count'=>fake()->numberBetween(),
        ];
    }
}
