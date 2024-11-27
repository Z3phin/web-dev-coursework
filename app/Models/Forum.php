<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represents a forum, where users can put thier posts.
 * A user owns a forum, and a forum has members which are users. 
 * Those members may be moderators.
 * Some users may be banned from the forum. 
 * 
 */
class Forum extends Model
{
    use HasFactory;

    /**
     * Returns the owner of this forum.
     * 
     * @return BelongsTo AppUser
     */
    public function owner() : BelongsTo {
        return $this->belongsTo(AppUser::class);
    }

    /**
     * Returns the members that belong to this forum.
     * 
     * @return BelongsToMany users.
     */
    public function members() : BelongsToMany {
        return $this->belongsToMany(
            AppUser::class,
            'forum_users',
            'forum_id',
            'app_user_id',
            'id',
            'id'
        );
    }

    /**
     * Returns the moderators for this forum.
     * 
     * @return BelongsToMany moderators.
     */
    public function moderators() : BelongsToMany {
        return $this->members()->wherePivot('role', '=', 'moderator');
    }

    /**
     * Returns the users who are banned from this forum.
     * 
     * @return BelongsToMany banned users.
     * 
     */
    public function bannedUsers() : BelongsToMany {
        return $this->belongsToMany(
            AppUser::class,
            'banned_forum_users',
            'forum_id',
            'app_user_id',
            'id',
            'id'
        );
    }

    /**
     * Returns the posts that have been made on this forum.
     * 
     * @return HasMany posts.
     */
    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }
}

