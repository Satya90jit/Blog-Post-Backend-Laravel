<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogUser;


class BlogPost extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(BlogUser::class);
    }
    public function category()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
