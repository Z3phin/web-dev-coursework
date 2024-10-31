<?php

namespace Database\Factories;

use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppUser>
 */
class AppUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parentUser = User::factory()->create();
        return [
            'user_id' => $parentUser->id,
            'username' => fake()->unique->userName(),
            'pronouns' => fake()->randomElement([
                'he\him',
                'she\her',
                'they\them'
            ]),
            'status' => fake()->sentence(),
            'about' => fake()->paragraph(),
            'xp_count' => fake()->numberBetween(),
            'level' => fake()->randomElement([
                'gamer',
                'student',
                'trainee',
                'junior',
                'developer',
                'senior',
                'leader'
            ]),
            'last_online' => fake()->dateTimeBetween($parentUser->created_at, '+1 week')
        ];
    }
}
