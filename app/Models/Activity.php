<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * An activity, such as a post or comment, that can be made on the app that belongs to a user.
 * These may have many comments.
 * 
 * 
 */
class Activity extends Model
{
    use HasFactory;

    /**
     * Returns the user that this activity belongs to.
     * 
     * @return BelongsTo user.
     */
    public function appUser() : BelongsTo {
        return $this->belongsTo(AppUser::class);
    }

    /**
     * Returns the parent type of this activity (Post or Comment).
     * 
     * @return MorphTo parent type.
     */
    public function commentable() : MorphTo {
        return $this->morphTo('commentable');
    }

    /**
     * Returns the comments belonging to this activity.
     * 
     * @return HasMany comments.
     */
    public function comments() : HasMany {
        return $this->hasMany(Comment::class, 'parent_activity_id');
    }
}
