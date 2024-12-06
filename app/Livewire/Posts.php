<?php

namespace App\Livewire;

use App\Models\Forum;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Posts extends Component
{

    public Forum $forum;
    public Collection $posts;

    public function mount(Forum $forum) {
        $this->forum = $forum;
        $this->posts = $this->forum->posts->load('activity');
        $this->posts = $this->posts->sortByDesc('created_at');
    }

    #[On('post-created')]
    public function postCreated(int $postId) {
        $post = Post::findOrfail($postId);
        $this->posts = $this->posts->prepend($post);
    }

    // public function postDeleted(int $deletedId) {
    //     $this->posts = $this->posts->reject(function ($post, int $key) use ($deletedId) {
    //         return $post->id == $deletedId;
    //     });
    // }

    public function render()
    {
        return view('livewire.posts');
    }
}
