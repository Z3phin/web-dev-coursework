<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // A known comment on a post used for testing

        $comment = new Comment;
        $comment->parent_activity_id=1; // test post with id of 1
        $comment->save();

        $activity = new Activity;
        $activity->app_user_id=2;
        $activity->commentable_type="App\Models\Comment";
        $activity->commentable_id=$comment->id;
        $activity->body="This is a comment\'s body";
        $activity->like_count=100;
        $activity->dislike_count=10;
        $activity->save();


        // A known comment on a comment used for testing
        $commentOnComment = new Comment;
        $commentOnComment->parent_activity_id=$comment->activity->id;
        $commentOnComment->save();

        $activity2 = new Activity;
        $activity2->app_user_id=3;
        $activity2->commentable_type="App\Models\Comment";
        $activity2->commentable_id=$commentOnComment->id;
        $activity2->body="This is a comment\'s body";
        $activity2->like_count=100;
        $activity2->dislike_count=10;        
        $activity2->save();

        Comment::factory()->count(400)->create();
    }
}
