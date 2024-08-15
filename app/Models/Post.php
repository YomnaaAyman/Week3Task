<?php

namespace App\Models;

use PhpParser\Comment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'title',
        'content',
        'slug',
        'is_published'
    ];
    protected $casts =
    [
        'is_punlished'=>'boolean'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }

}
