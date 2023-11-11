<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResources;

class CommentController extends Controller
{
    use HttpResponses;

    public function index($user_id)
    {

        return CommentResources::collection(Comment::where('user_id', $user_id)->get()->all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'integer',
            'post_id' => 'required|integer'
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->post_id,
            'content' => $request->content
        ]);

        return $this->success('', 'comment created successfully', 201);
    }





    public function update(Request $request, Comment $comment)
    {

        if (!$this->isAuthorize($comment)) {
            return $this->error('', 'you are not authorize to update', 403);
        }
        $request->validate([
            'content' => 'required|string',
        ]);
        $comment->update([
            'content' => $request->content
        ]);

        return $this->success('', 'comment updated successfully', 200);
    }


    public function destroy(Comment $comment)
    {

        if (!$this->isAuthorize($comment)) {
            return $this->error('', 'you are not authorize to delete this comment', 403);
        }

        $comment->delete();
        return $this->success('', 'comment deleted successfully', 200);
    }
}
