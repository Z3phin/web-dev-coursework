<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Activity
{
    use HasFactory;

    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }
}
