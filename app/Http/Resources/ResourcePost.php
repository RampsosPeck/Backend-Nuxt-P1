<?php

namespace App\Http\Resources;

use App\Http\Resources\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourcePost extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body'=> $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => $this->user,
            'like_count' => $this->likes->count(),
            // Este User::collection es el resource no el modelo
            'users' => User::collection($this->likes->pluck('user')),
        ];
    }
}
