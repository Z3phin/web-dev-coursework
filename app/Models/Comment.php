<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends Activity 
{
    use HasFactory;

    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }
}
