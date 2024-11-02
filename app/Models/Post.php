<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Represents a post, which has a title, that has been made by a user.
 * 
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Returns the activity that this Post has. This contains the main content of the post.
     * 
     * @return MorphOne activity.
     */
    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }

    /**
     * Returns the comments that have been made on this post.
     * 
     * @return HasManyThrough comments.
     */
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

    /**
     * Returns the forum that this post was made to.
     * 
     * @return BelongsTo forum. 
     */
    public function forum() : BelongsTo {
        return $this->belongsTo(Forum::class);
    }
}
