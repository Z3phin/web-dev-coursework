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
    }
}
