<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AppUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A known user / appUser used for testing
        $user = new User();
        $user->name = "Matthew";
        $user->email = "Matt@email.com";
        $user->password = "password";
        $user->save();

        $appUser = new AppUser();
        $appUser->user_id = $user->id;
        $appUser->username = "Zephin"; 
        $appUser->pronouns = "he\him";
        $appUser->status = "Currenty seeding";
        $appUser->about = "I am the person who made this :) I do stuff.";
        $appUser->xp_count = 800;
        $appUser->level = 'student';
        $appUser->last_online = $user->created_at;
        $appUser->save();

        AppUser::factory()->count(50)->create();

        foreach (AppUser::all() as $user) {
            // Generate up to 10 random users ids to add to the forum 
            $friendIDs = fake()->randomElements(
                range(1, AppUser::count()), 
                fake()->numberBetween(0, 10)
            );
    
            // Ensure user does not friend themselves
            $friendIDs = array_diff($friendIDs, [$user->id]);

            foreach ($friendIDs as $id) {

                $user->followers()->attach($id);
            }
        }  

    }
}
