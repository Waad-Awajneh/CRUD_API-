<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResources;
use App\Http\Resources\PostResources;
use App\Models\Comment;
use App\Models\Post;

// ------------------- public endPoints ----------------------

Route::post('/login',           [AuthController::class, 'login']);
Route::post('/register',        [AuthController::class, 'register']);

//for testing purposes
Route::get('/users', function () {
    return UserResources::collection(User::all());
});
Route::get('/user/{id}', function ($id) {
    return new UserResources(User::findOrFail($id));
});


//join testing- users with posts and comments endpoint
Route::get('/usersWithPosts', [Controller::class, 'usersWithPosts']);
Route::get('/usersWithPostsAndComments', [Controller::class, 'usersWithPostsAndComments']);




// ------------------- authenticated endPoints ----------------------

//users endpoint
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {

        return new UserResources(Auth::user());
    });
});


//comments endpoint
Route::middleware('auth')->group(function () {

    Route::get('/user_comments/{user_id}', [CommentController::class, 'index']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::put('/comment/{comment}', [CommentController::class, 'update']);
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy']);

});
 

//posts endpoint
Route::middleware('auth')->group(function () {

    Route::get('/user_posts/{user_id}', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::put('/post/{post}', [PostController::class, 'update']);
    Route::delete('/post/{post}', [PostController::class, 'destroy']);
    
});