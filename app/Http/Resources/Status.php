<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Status extends JsonResource
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
            'name'  => $this->name,
            'label' => __("status.{$this->name}")
        ];
    }
}
