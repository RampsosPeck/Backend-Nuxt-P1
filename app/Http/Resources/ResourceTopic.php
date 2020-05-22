<?php

namespace App\Http\Resources;

use App\Http\Resources\ResourcePost;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceTopic extends JsonResource
{

    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'posts' => ResourcePost::collection($this->posts),
            'user' => $this->user,

        ];


    }

}
