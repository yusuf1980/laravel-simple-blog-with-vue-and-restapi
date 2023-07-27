<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'post_id',
        'user_id',
        'comment'
    ];

    // protected function created(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i')
    //     );
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function like(): morphOne
    {
        return $this->morphOne(Like::class, 'likeable');
    }
    
}
