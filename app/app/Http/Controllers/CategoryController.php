<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogUser;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    function allCategory()
    {
        return BlogCategory::all();
    } 
    function singleCategory($id)
    {
        return BlogCategory::find($id);
    }
    function createCategory(Request $req)
    {
        $category= new BlogCategory;
        $category->category=$req->category;
        $result=$category->save();


    if ($result)
    {

        return ["category created successfully"];
    }
    else{
        return ["category not created"];

    }
    }
    function deleteCategory($id)
    {
        $category=BlogCategory::find($id);
        $result=$category->delete();
        
        if ($result)
        {
            
            return [" Category successfully"];
        }
        else{
            return [" Category Not Found"];
            
        }
    }

    function UsersCategories($userId)
    {
        $result = DB::table('blog_posts')
                    ->join('blog_users', 'blog_posts.blog_user_id', '=', 'blog_users.id')
                    ->join('blog_categories', 'blog_posts.category_id', '=', 'blog_categories.id')
                    ->where('blog_users.id', $userId)
                    ->select('blog_categories.category')
                    ->get();
        
        return $result;
    }
    
    
    
    

  
}
