<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\AppUser;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateComment extends Component
{

    public bool $isHidden;
    public Activity $activity;
    public AppUser $user;
    public string $body;

    public function mount(Activity $activity) {
        $this->user = Auth::user()->appUser;
        $this->isHidden = true;  
        $this->activity = $activity;
        $this->body = '';

    }

    public function toggleHide() {
        $this->isHidden = !$this->isHidden;
    }

    public function createComment() {
        $this->validate([
            'body' => 'required|string|max:65535'
        ]);

        $comment = new Comment();
        $comment->parent_activity_id = $this->activity->id;
        $comment->save();
        
        $activity = new Activity();
        $activity->app_user_id = $this->user->id;
        $activity->commentable_type = "App\Models\Comment";
        $activity->commentable_id = $comment->id;
        $activity->body = $this->body;
        $activity->like_count = 0;
        $activity->dislike_count = 0;
        $activity->save();

        $this->dispatch('comment-created', commentId: $comment->id);

        $this->resetForm();
        $this->isHidden = true;
        
    }

    public function resetForm() {
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}
