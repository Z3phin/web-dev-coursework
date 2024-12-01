<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Component;

class LikeButton extends Component
{

    public $activity; 
    public bool $isLiked = false; 

    public function mount(Activity $activity) {
        $this->activity = $activity;

    }

    public function click() {
        if (!$this->isLiked) {
            $this->activity->like_count++;
            $this->activity->save(); 
            $this->isLiked = true;
        } else {
            $this->activity->like_count--;
            $this->activity->save(); 
            $this->isLiked = false;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
