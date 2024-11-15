<?php

namespace App\View\Components\activities;

use App\Models\Comment as ModelsComment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $username = 'unknown',
        public string $likes = '0',
        public string $dislikes = '0',
        public string $date = ''
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.activities.comment');
    }
}
