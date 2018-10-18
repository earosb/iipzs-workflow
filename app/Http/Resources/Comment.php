<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'created_by'  => $this->createdBy->name,
            'created_at'  => $this->created_at->diffForHumans(),
            'description' => $this->description,
        ];
    }
}
