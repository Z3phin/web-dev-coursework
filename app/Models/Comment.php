<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;


/**
 * Represents a comment on a commentable activity, including a post or another comment.
 * 
 */
class Comment extends Model 
{
    use HasFactory;

    /**
     * Returns the main activity this comment is related to.
     * 
     * @return MorphOne activity.
     */
    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }

    /**
     * Returns the parent activity, which may be a post or a comment, that this 
     * comment belongs to.
     * 
     * @return BelongsTo activity.
     */
    public function parent_activity() : BelongsTo {
        return $this->belongsTo(Activity::class, 'parent_activity_id');
    }

    /**
     * Returns the comments that belong to this comment.
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
}
