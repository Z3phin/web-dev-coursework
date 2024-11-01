<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_activity_id'=>fake()->numberBetween(1, Activity::get()->count())
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            Activity::factory()->state([
                'commentable_type'=>'App\Models\Comment',
                'commentable_id'=>$comment->id
            ])->create();
        });
    }
}
