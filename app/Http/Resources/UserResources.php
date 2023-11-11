<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'user_id' => $this->id,
            'user_name' => $this->name,
            'email' => $this->email,
            "posts" => $this->posts->count(),
            "comments" => $this->comments->count(),
        ];
    }
}
