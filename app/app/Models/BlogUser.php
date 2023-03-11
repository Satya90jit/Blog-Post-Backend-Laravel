<?php

namespace App\Models;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\BlogPost;
use App\Models\Comment;


class BlogUser extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $fillable = ['first_name','last_name','name','email','password', 'role'];



    public function blogs()
    {
        return $this->hasMany(BlogPost::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function category()
    {
        return $this->hasMany(BlogCategory::class);
    }
}
