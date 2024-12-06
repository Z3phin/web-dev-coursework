<?php

namespace App\Livewire;

use App\Models\AppUser;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostItem extends Component
{

    public Post $post;
    public bool $canDelete; 

    public function mount(Post $post) {
        $this->post = $post;
        if (Auth::check()) {
            $this->canDelete = Auth::user()->appUser == $this->post->activity->appUser;
        } else {
            $this->canDelete = false; 
        }
    }

    public function delete() {
        if ($this->canDelete) {
            $this->post->delete();
            $this->dispatch('post-deleted', $this->post->id);
        } 
        
    }

    public function render()
    {
        return view('livewire.post-item');
    }
}
