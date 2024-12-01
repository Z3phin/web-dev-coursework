<?php

namespace App\Livewire;

use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FollowButton extends Component
{
    public AppUser $user;
    public bool $isFollowing;

    protected $listeners = [
        'follow' => '$refresh',
        'unfollow' => '$refresh'
    ];

    public function mount(AppUser $user) {
        $this->user = $user;
        $this->isFollowing = Auth::user()->appUser->follows($this->user);
    }

    public function follow() {
        Auth::user()->appUser->following()->attach($this->user->id);
        $this->isFollowing = true; 
    }

    public function unfollow() {
        Auth::user()->appUser->following()->detach($this->user->id);
        $this->isFollowing = false; 
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
