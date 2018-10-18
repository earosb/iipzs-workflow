<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class Attachment extends JsonResource
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
            'name'      => $this->name,
            'mime_type' => $this->mime_type,
            'thumbnail' => Storage::url($this->path),
            'original'  => Storage::url($this->path),
        ];
    }
}
