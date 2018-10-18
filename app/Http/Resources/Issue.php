<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Issue extends JsonResource
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
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'created_by'   => new User($this->createdBy),
            'created_at'   => $this->created_at->diffForHumans(),
            'assigned_to'  => new User($this->assignedTo),
            'status'       => new Status($this->status),
            'attachements' => Attachment::collection($this->attachments),
            'comments'     => Comment::collection($this->whenLoaded('comments')),
        ];
    }
}
