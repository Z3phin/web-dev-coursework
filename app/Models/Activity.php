<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    use HasFactory;

    public function appUser() : BelongsTo {
        return $this->belongsTo(AppUser::class);
    }

    public function commentable() : MorphTo {
        return $this->morphTo('commentable');
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class, 'parent_activity_id', 'id');
    }
}
