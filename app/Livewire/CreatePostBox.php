<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\AppUser;
use App\Models\Forum;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class CreatePostBox extends Component
{

    public bool $isHidden;
    public Forum $forum;
    public AppUser $user;
    public string $title;
    public string $body;  


    public function mount(Forum $forum) {
        $this->user = Auth::user()->appUser;
        $this->isHidden = true;  
        $this->forum = $forum;
        $this->title = '';
        $this->body = '';

    }

    public function toggleHide() {
        $this->isHidden = !$this->isHidden;
    }

    public function createPost() {
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:65535'
        ]);

        $post = new Post();
        $post->forum_id = $this->forum->id;
        $post->title = $this->title;
        $post->save();
        
        $activity = new Activity();
        $activity->app_user_id = $this->user->id;
        $activity->commentable_type = "App\Models\Post";
        $activity->commentable_id = $post->id;
        $activity->body = $this->body;
        $activity->like_count = 0;
        $activity->dislike_count = 0;
        $activity->save();

        $this->dispatch('post-created', postId: $post->id);

        $this->resetForm();
        $this->isHidden = true;
        
    }

    public function resetForm() {
        $this->title = '';
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.create-post-box');
    }
}
