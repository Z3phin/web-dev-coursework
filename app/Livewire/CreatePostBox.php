<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePostBox extends Component
{

    public bool $isHidden;

    public function mount() {
        $this->isHidden = true;  
    }

    public function toggleHide() {
        $this->isHidden = !$this->isHidden;
    }

    public function render()
    {
        return view('livewire.create-post-box');
    }
}
