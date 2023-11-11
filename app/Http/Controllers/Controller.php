<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Traits\HttpResponses;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HttpResponses;

    public function usersWithPosts()
    {
        $usersWithPosts = User::join('posts', 'users.id', '=', 'posts.user_id')
            ->get(['users.*', 'posts.title as post_title', 'posts.content as post_content']);
        return $this->success(
            ['data' => $usersWithPosts],

            'get data successfully',
            200
        );
    }

    public function usersWithPostsAndComments()
    {
        $usersWithPostsAndComments = User::join('posts', 'users.id', '=', 'posts.user_id')
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->get(['users.*', 'posts.title as post_title', 'posts.content as post_content', 'comments.content as comment_content']);
        return $this->success(
            ['data' => $usersWithPostsAndComments],

            'get data successfully',
            200
        );
    } 
    

}