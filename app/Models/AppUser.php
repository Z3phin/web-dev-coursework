<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Represents an user who will use the app and has relevant attributes to it. An AppUser is related to 
 * a User, which handles the user's sensitive information. 
 * 
 * An AppUser can make posts, comments, own forums, be a member of a forum, moderate a forum, be banned
 * from forums and follow other users.
 * 
 */
class AppUser extends Model
{
    use HasFactory;

    /**
     * Returns the User model that this AppUser belongs to.
     * 
     * @return BelongsTo user.
     */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the activities that belong to this user, such as posts and comments.
     * 
     * @return HasMany activities.
     */
    public function activities() : HasMany {
        return $this->hasMany(Activity::class);
    } 

    /**
     * Retuns the posts that this user has made.
     * 
     * @return HasManyThrough posts.
     */
    public function posts() : HasManyThrough {
        return $this->hasManyThrough(
            Post::class,
            Activity::class,
            'app_user_id',
            'id',
            'id',
            'commentable_id'
        );
    }

    /**
     * Returns the comments that this user has made.
     * 
     * @return HasManyThrough comments.
     */
    public function comments() : HasManyThrough {
        return $this->hasManyThrough(
            Comment::class,
            Activity::class,
            'app_user_id',
            'id',
            'id',
            'commentable_id'
        );
    }

    /**
     * Returns the forums that this user owns. 
     * 
     * @return HasMany forums.
     */
    public function ownForums() : HasMany {
        return $this->hasMany(
            Forum::class,
            'owner_id',
            'id'
    );
    }

    /**
     * Returns the forums that this user is a member of.
     * 
     * @return BelongsToMany forums.
     */
    public function memberOf() : BelongsToMany {
        return $this->belongsToMany(
            Forum::class,
            'forum_users',
            'app_user_id',
            'forum_id',
            'id',
            'id'
        );
    }

    /**
     * Returns the forums that this user moderates. 
     * A moderator is also a member of a forum.
     * 
     * @return BelongsToMany forums.
     * 
     */
    public function moderatorOf() : BelongsToMany {
        return $this->memberOf()->wherePivot('role', '=', 'moderator');
    }

    /**
     * Returns the forums that this user is banned from.
     * 
     * @return BelongsToMany forums.
     */
    public function bannedFrom() : BelongsToMany {
        return $this->belongsToMany(
            Forum::class,
            'banned_forum_users',
            'app_user_id',
            'forum_id',
            'id',
            'id'
        );    
    }

    /**
     * Returns the users that this user follows.
     * 
     * @return BelongsToMany users.
     */
    public function following() : BelongsToMany {
        return $this->belongsToMany(
            AppUser::class,
            'user_followers',
            'app_user_id',
            'follower_id',
            'id',
            'id'
        );
    }

    public function follows(AppUser $user) {
        return $this->following->contains($user);
    }

    /**
     * Returns the users that follow this user.
     * 
     * @return BelongsToMany users.
     */
    public function followers() : BelongsToMany {
        return $this->belongsToMany(
            AppUser::class,
            'user_followers',
            'follower_id',
            'app_user_id',
            'id',
            'id'
        );
    }

}

