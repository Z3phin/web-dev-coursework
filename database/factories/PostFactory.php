<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'forum_id' => fake()->numberBetween(1, Forum::count()),
            'title' => fake()->sentence()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            Activity::factory()->state([
                'commentable_type'=>'App\Models\Post',
                'commentable_id'=>$post->id
            ])->create();
        });
    }
}
