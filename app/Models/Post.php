<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model 
{
    protected $fillable = [
        'title',
        'content',
        'image_path',
        'user_id'  
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('/public/images/default-post.jpg'); 
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function interests(): BelongsToMany
    // {
    //     return $this->belongsToMany(Interest::class, 'interests_posts');
    // }
}

