<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreThumbResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_description' => $this->description,
            'category' => $this->category->label,
            'thumbnails' => '',
            'coord' => [$this->lat, $this->lng],
        ];
    }
}
