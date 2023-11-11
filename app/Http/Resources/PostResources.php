<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResources extends JsonResource
{
 
    public function toArray($request)
    {
        return
            [
                'postId' => $this->id,
                'postOwnerId' => $this->user->id,
                'postOwner' => $this->user->name,
                'title' => $this->title,
                'content' => $this->content,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'post_Comments' => CommentResources::collection($this->comments)
            ];
    }
}
