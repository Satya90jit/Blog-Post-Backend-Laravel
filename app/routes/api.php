<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registrationn 
Route::post("registration",[UserController::class ,"registration"]);
Route::post("login",[UserController::class ,"login"]);


// Users 
Route::get("allUsers",[UserController::class ,"allusers"]);
Route::get("singleUser/{id}",[UserController::class ,"singleUser"]);
Route::get("updateUser/{id}",[UserController::class ,"updateUser"]);
Route::post("makeAdmin/{id}",[UserController::class ,"makeAdmin"]);
Route::post("terminateAdmin/{id}",[UserController::class ,"terminateAdmin"]);

// BlogsPosts
Route::post("createBlog/{id}",[BlogsController::class ,"createBlog"]);
Route::delete("deleteBlog/{id}",[BlogsController::class ,"deleteBlog"]);
Route::post("updateBlog/{id}",[BlogsController::class ,"updateBlog"]);
Route::get("allBlogs",[BlogsController::class ,"allBlogs"]);
Route::get("singleBlog/{id}",[BlogsController::class ,"singleBlog"]);
Route::get("getUsersBlog/{id}",[BlogsController::class ,"getUsersBlog"]);
Route::get('/allBlogs/allCategory/{id}', [BlogsController::class ,"filterBlogsByCategory"]);

// Comments 
Route::post("createComment/{id}",[CommentController::class ,"createComment"]);
Route::post("updateComment",[CommentController::class ,"updateComment"]);
Route::delete("deleteComment/{id}",[CommentController::class ,"deleteComment"]);
Route::get("allComments",[CommentController::class ,"allComments"]);
Route::get("singleComment/{id}",[CommentController::class ,"singleComment"]);
Route::get("getBlogComments/{id}",[CommentController::class ,"getBlogComments"]);

// Categories
Route::get("allCategory",[CategoryController::class ,"allCategory"]);
Route::get("singleCategory/{id}",[CategoryController::class ,"singleBlog"]);
Route::post("createCategory",[CategoryController::class ,"createCategory"]);
Route::get("UsersCategories/{id}",[CategoryController::class ,"UsersCategories"]);
Route::delete("deleteCategory/{id}",[CategoryController::class ,"deleteCategory"]);