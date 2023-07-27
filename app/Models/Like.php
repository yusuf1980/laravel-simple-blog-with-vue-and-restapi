<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'is_like',
        'likeable_id',
        'likeable_type',
    ];

    // protected $casts = [
    //     'is_like' => 'boolean'
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
