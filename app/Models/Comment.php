<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends Activity 
{
    use HasFactory;

    public function activity() : MorphOne {
        return $this->morphOne(Activity::class, 'commentable');
    }

    public function parent_activity() : BelongsTo {
        return $this->belongsTo(Activity::class, 'id', 'parent_activity_id');
    }
}
