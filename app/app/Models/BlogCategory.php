<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class);
    }
    public function category()
    {
        return $this->belongsTo(BlogUser::class);
    }
    
}
