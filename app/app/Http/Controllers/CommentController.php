<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Models\BlogUser;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    function allComments()
    {
        return Comment::all();
    } 
    function singleComment($id)
    {
        return Comment::find($id);
    }
    function createComment(Request $req , $id )
    {
        $blog=BlogPost::find($id);


        // $comment = Comment::find($comment_id);
        // if ($comment) {
        //     $user_id = $comment->user->id;
        //     return $user_id;
        // }

        // $user=BlogUser::find($id);
        // $user= BlogUser::where('id', $req->id)->first();
        $comment = Comment::find($id);
        // if ($comment) {
        //     $blog_user_id = $comment->blogUser->$id;
        //     // return $blog_user_id;
        // }
        // Implment in update and delete accordingly

        $comments= new Comment;
        $comments->comment=$req->comment;
        $comments->blog_post_id=$blog->id;
        // $comments->blog_user_id=$blog_user_id;
        $result=$comments->save();

        if ($result)
        {
            return ["Comment added successfully"];
        }
        else{
            return ["Failed to add comment"];

        }
  
    }
    
    // function getBlogComments($id)
    // {

    //     $blogId=BlogPost::find($id);
    //     // dd($blog=BlogPost::find($id)->id);
    //     // dd($blog);
    //     $comments = $blogId->comments;
    //     // dd($comments);
    //     return $comments;

    // }
    function getBlogComments($id)
    {

        $blogId = BlogPost::find($id);
        $comments = $blogId->comments;

        $result = DB::table('blog_users')
                    ->join('comments', 'blog_users.id', '=', 'comments.id')
                    ->where('comments.blog_post_id', $id)
                    ->select('blog_users.user_name', 'comments.*')
                    ->get();

        return $result;

    }

    
    function deleteComment($id)
    {
        $comment=Comment::find($id);
        $result=$comment->delete();

        if ($result)
        {
            
            return ["Comment Deleted successfully"];
        }
        else{
            return ["Comment Not Deleted"];
            
        }
    }

}
