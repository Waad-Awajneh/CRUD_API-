<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResources;

class PostController extends Controller
{
    use HttpResponses;
  
    public function index($user_id)
    {
        return PostResources::collection(Post::where('user_id', $user_id)->get()->all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return $this->success('', 'post created successfully', 201);
    }




    public function update(Request $request, Post $post)
    {
        if (!$this->isAuthorize($post)) {
            return $this->error('', 'you are not authorize to update', 403);
        }
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return $this->success('', 'post updated successfully', 200);
    }

 
    public function destroy(Post $post)
    {

        if (!$this->isAuthorize($post)) {
            return $this->error('', 'you are not authorize to delete this post', 403);
        }

        $post->delete();
        return $this->success('', 'post deleted successfully', 200);
    }
}
