<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;

    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }

    public function comments() : HasManyThrough {
        return $this->hasManyThrough(
            Comment::class, 
            Activity::class,
            'commentable_id',
            'parent_activity_id',
            'id',
            'id'
        );
    }
}
