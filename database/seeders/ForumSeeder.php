<?php

namespace Database\Seeders;

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

        
    }
}
