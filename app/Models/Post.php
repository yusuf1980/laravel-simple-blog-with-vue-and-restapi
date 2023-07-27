<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Carbon\Carbon;
use Auth;
// use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'status',
        'total_like',
        'total_dislike',
        'published_date',
        'content',
    ];

    public function comments(): HasMany
    {
    	return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): MorphOne
    {
        return $this->morphOne(Like::class, 'likeable');
    }

    public function like(): MorphOne
    {
        $user = Auth::user();
        return $this->morphOne(Like::class, 'likeable')->where('user_id', $user->id);
    }

    public function dislike(): MorphOne
    {
        $user = Auth::user();
        return $this->morphOne(Like::class, 'likeable')->where('is_like', 0);
    }

    public function like_true(): MorphOne
    {
        $user = Auth::user();
        return $this->morphOne(Like::class, 'likeable')->where('is_like', 1);
    }

}
