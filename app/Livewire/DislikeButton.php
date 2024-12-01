<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Component;

class DislikeButton extends Component
{
    
    public $activity; 
    public bool $isDisliked = false; 

    public function mount(Activity $activity) {
        $this->activity = $activity;

    }

    public function click() {
        if (!$this->isDisliked) {
            $this->activity->dislike_count++;
            $this->activity->save(); 
            $this->isDisliked = true;
        } else {
            $this->activity->dislike_count--;
            $this->activity->save(); 
            $this->isDisliked = false;
        }
    }
    
    public function render()
    {
        return view('livewire.dislike-button');
    }
}
