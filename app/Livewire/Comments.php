<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Comments extends Component
{
   

    public Activity $activity;
    public Collection $comments;

    public function mount($activity) {
        $this->activity = $activity;
        $this->comments = $this->activity->comments->load('activity');
    }

    #[On('comment-created')]
    public function postCreated(int $commentId) {
        $comment = Comment::findOrfail($commentId);
        $this->comments = $this->comments->prepend($comment);
    }

    // public function postDeleted(int $deletedId) {
    //     $this->posts = $this->posts->reject(function ($post, int $key) use ($deletedId) {
    //         return $post->id == $deletedId;
    //     });
    // }

    public function render()
    {
        return view('livewire.comments');
    }

}



