<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'comment_id' => $this->id,
            'comment_content' => $this->content,
            'commentOwner' => $this->user->name,
            'commentOwnerId' => $this->user->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'post_info' => [
                'postOwner' => $this->post->user->name,
                'postOwnerID' => $this->post->user->id,
            ]
        ];
    }
}