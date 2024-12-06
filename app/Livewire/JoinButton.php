<?php

namespace App\Livewire;

use App\Models\AppUser;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JoinButton extends Component
{

    public Forum $forum;
    public AppUser $user;
    public bool $isFollowing; 

    public function mount(Forum $forum) {
        $this->forum = $forum;
        $this->user = Auth::user()->appUser;
        $this->isFollowing = $this->user->memberOf()->wherePivot('forum_id', '=', $forum->id)->exists();
    }

    public function join() {
        if (!$this->isFollowing) {
            $this->user->memberOf()->attach($this->forum->id,  ['joined_at' => now(), 'role' => 'member']);
            $this->toggleIsFollowing();
        }
    }

    public function leave() {
        if ($this->isFollowing) {
            $this->user->memberOf()->detach($this->forum->id);
            $this->toggleIsFollowing();
        }
    }

    private function toggleIsFollowing() {
        $this->isFollowing = !$this->isFollowing;
    }


    public function render()
    {
        return view('livewire.join-button');
    }
}
