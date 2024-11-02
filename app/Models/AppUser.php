<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class AppUser extends Model
{
    use HasFactory;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function activities() : HasMany {
        return $this->hasMany(Activity::class);
    } 

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

    public function ownForums() : HasMany {
        return $this->hasMany(Forum::class);
    }

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

    public function moderatorOf() : BelongsToMany {
        
    }

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

}

