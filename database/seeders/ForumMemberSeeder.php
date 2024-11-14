<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\AppUser;
use Illuminate\Database\Seeder;

class ForumMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add members to all the forums
        foreach (Forum::all() as $forum) {
            // Generate up to 10 random users ids to add to the forum 
            $ids = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 10)
            );

            // Ensure owner is not included in member pool
            $ids = array_diff($ids, [$forum->owner_id]);

            // Add each user to the forum with a random role and random join date
            foreach ($ids as $id) {
                $forum->members()->attach(
                    $id,
                    [
                        'role' => fake()->randomElement(['member', 'moderator']),
                        'joined_at' => fake()->dateTimeBetween(
                            $forum->created_at,
                            '+1 week'
                        )
                    ]
                    );
            } 
        }
    }
}
