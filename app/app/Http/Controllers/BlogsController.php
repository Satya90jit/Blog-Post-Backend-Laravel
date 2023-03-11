<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogUser;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;


class BlogsController extends Controller
{
    function allBlogs()
    {
        return BlogPost::all();

    } 
    function singleBlog($id)
    {
        return BlogPost::find($id);
    }
    function createBlog( Request $req  )
    {

            $req->validate([

            'image'=>'required', 
            'title'=>'required',
            'description'=>'required',
            'category'=>'required'
            
            ]);
    

    $user=BlogUser::find($req -> id);
    $category= BlogCategory::where('category', $req->category)->first();

    $blog= new BlogPost;
    $blog->title=$req->title;
    $blog->description=$req->description;
    $blog->category=$req->category;
    $blog->blog_user_id=$user->id;
    $blog->category_id=$category->id;
  
    $file = $req->file('image');
    $extension= $file->getClientOriginalExtension();
    $fileName = time().'.'.$extension;
    $file->image=$req->file('image')->storeAs('postImages', $fileName);
    $blog->image='postImages/'.$fileName;
    $result=$blog->save();


    if ($result)
    {

        return ["Registered successfully"];
    }
    else{
        return ["Not Registered"];

    }
    

    }

    function updateBlog(Request $req , $id)
    {    

            $req->validate([

            'title'=>'required',
            'description'=>'required',
            'category'=>'required'
            
            ]);

        $blog=BlogPost::find($id);
        $blog->title=$req->title;
        $blog->description=$req->description;
        $blog->category=$req->category;


        if($req->hasFile('image'))
        {

        $file = $req->file('image');
        $extension= $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $file->image=$req->file('image')->storeAs('postImages', $fileName);
        $blog->image='postImages/'.$fileName;
        $result=$blog->save();

        }
        else
        {
            $imgdata = BlogPost::find($id);
            $blog->image=$imgdata->image;
            $result=$blog->save();
        }
    }

    function filterBlogsByCategory($id)
    {
        $blogs = BlogPost::where('category_id', $id)->get();
        return $blogs;
    }


    function getUsersBlog($id)
    {
        $user = BlogUser::find($id);
        $blogs = $user->blogs;
        return $blogs;
    }

    function deleteBlog($id)
    {
        $blog=BlogPost::find($id);
        $result=$blog->delete();

        if ($result)
        {
            
            return ["Blog Deleted successfully"];
        }
        else{
            return ["Blog Not Deleted"];
            
        }
    }
    
 
}
