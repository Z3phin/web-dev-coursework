<?php

namespace Database\Seeders;

use App\Models\AppUser;
use App\Models\Forum;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\search;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A known forum used for testing
        $forum = new Forum;

        $forum->name='general';
        $forum->description='Welcome to General. Anything can be posted here :)';
        $forum->save();

        Forum::factory()->count(20)->create();

        // Add members to all the forums
        foreach (Forum::all() as $forum) {
            // Generate up to 10 random users ids to add to the forum 
            $ids = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 10)
            );

            // Ensure owner is not included in member pool
            $ids = array_diff($ids, [$forum->owner_id]);

            // Generate up to 3 random user ids to be banned 
            $bannedIDs = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 3)
            );

            // Ensure generated bannedIDs are not members or owner
            $bannedIDs = array_diff($bannedIDs, $ids, [$forum->owner_id]);


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


            // Add banned users to forums
            foreach ($bannedIDs as $id) {

                $bannedAt = fake()->dateTimeBetween(
                    $forum->created_at, 
                    '+1 year');

                $bannedUntil = fake()->dateTimeBetween($bannedAt, '+2 years');

                $forum->bannedMembers()->attach(
                    $id,
                    [
                        'reason' => fake()->sentence(),
                        'banned_at' => $bannedAt,
                        'banned_until' => $bannedUntil
                    ]
                );
            } 
        }
        
    }
}
