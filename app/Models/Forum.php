<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Forum extends Model
{
    use HasFactory;

    public function owner() : BelongsTo {
        return $this->belongsTo(AppUser::class);
    }

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

    public function moderators() : BelongsToMany {
        return $this->members()->wherePivot('role', '=', 'moderator');
    }

    public function bannedMembers() : BelongsToMany {
        return $this->belongsToMany(
            AppUser::class,
            'banned_forum_users',
            'forum_id',
            'app_user_id',
            'id',
            'id'
        );
    }
}
