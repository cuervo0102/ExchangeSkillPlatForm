<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model 
{
    use HasFactory;

    protected $table = 'interests';

    protected $fillable = [
        'field',
        'interest',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'interest_user');
    }

    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class, 'interests_posts');
    // }
}