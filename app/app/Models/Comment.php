<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;
use App\Models\BlogUser;


class Comment extends Model
{
    use HasFactory;

    public function blog()
    {
        return $this->belongsTo(BlogPost::class);
    }
    public function blogUser()
    {
        return $this->belongsTo(BlogUser::class);
    }
}
