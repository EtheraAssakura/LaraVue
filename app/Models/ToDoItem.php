<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class ToDoItem extends Model
{
    use SoftDeletes, Hastags;

    protected $fillable = [
        'title',
        'more_info',
        'statut',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
