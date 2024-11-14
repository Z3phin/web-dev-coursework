<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\AppUser;
use Illuminate\Database\Seeder;

class ForumBannedUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add members to all the forums
        foreach (Forum::all() as $forum) {


            // Generate up to 3 random user ids to be banned 
            $bannedIDs = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 3)
            );

            // Ensure generated bannedIDs are not members or owner
            $bannedIDs = array_diff($bannedIDs, $forum->members()->pluck('id')->toArray(), [$forum->owner_id]);


            // Add banned users to forums
            foreach ($bannedIDs as $id) {

                $bannedAt = fake()->dateTimeBetween($forum->created_at, '+1 year');

                $bannedUntil = fake()->dateTimeBetween($bannedAt, '+2 years');

                $forum->bannedUsers()->attach(
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
