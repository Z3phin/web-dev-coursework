<?php

namespace App\Livewire;

use App\Models\Forum;
use App\Models\Post;
use App\Models\AppUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Psy\CodeCleaner\AssignThisVariablePass;

class Posts extends Component
{

    public Forum $forum;
    public Collection $posts;
    public AppUser $user;
    public bool $canPost;

    public function mount(Forum $forum) {
        $this->forum = $forum;
        $this->posts = $this->forum->posts->load('activity');
        $this->posts = $this->posts->sortByDesc('created_at');
        if (Auth::check()){
            $this->canPost = Auth::user()->appUser->memberOf()->where('forum_id', '=', $forum->id)->exists();
        } else {
            $this->canPost = false;
        }

    }

    #[On('post-created')]
    public function postCreated(int $postId) {
        $post = Post::findOrfail($postId);
        $this->posts = $this->posts->prepend($post);
    }

    #[On('join-forum')]
    public function joined() {
        $this->canPost = Auth::user()->appUser->memberOf()->where('forum_id', '=', $this->forum->id)->exists();
    }

    #[On('post-deleted')]
    public function postDeleted(int $deletedId) {
        $this->posts = $this->posts->reject(function ($post, int $key) use ($deletedId) {
            return $post->id == $deletedId;
        });
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
