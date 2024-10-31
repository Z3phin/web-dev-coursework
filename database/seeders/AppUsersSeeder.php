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
        $user = new User();
        $user->name = "Matthew Prickett";
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

    }
}
