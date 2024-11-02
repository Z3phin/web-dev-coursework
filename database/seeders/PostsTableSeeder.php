<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post;
        $post->forum_id =1;
        $post->title = 'Test post title';
        $post->save();

        $activity = new Activity;
        $activity->app_user_id = 1;
        $activity->commentable_type='App\\Models\\Post';
        $activity->commentable_id=$post->id;
        $activity->body="Test body for post";
        $activity->like_count=10;
        $activity->dislike_count=100;
        $activity->save();

        Post::factory()->count(100)->create();
    }
}
