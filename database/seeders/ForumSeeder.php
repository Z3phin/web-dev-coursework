<?php

namespace Database\Seeders;

use App\Models\AppUser;
use App\Models\Forum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forum = new Forum;

        $forum->name='general';
        $forum->description='Welcome to General. Anything can be posted here :)';
        $forum->save();

        Forum::factory()->count(20)->create();

        foreach (Forum::all() as $forum) {
            // Generate random users ids to add to the forum 
            $ids = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 10)
            );

            // Ensure that the owner is not added as a member
            $ids = array_diff($ids, [$forum->owner_id]);

            // Add each user to the forum with a random role and random join date
            for ($id = 0; $id < count($ids); $id++) {
                $forum->members()->attach(
                    $ids[$id],
                    [
                        'role' => fake()->randomElement(
                            ['member', 'moderator']
                        ),
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
