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
            'category_id' => $this->category->category_id == null ? $this->category->id : $this->category->category_id,
            'category' => $this->category->label,
            'thumbnails' => '',
            'latnlg' => [
                'lat' => $this->lat,
                'lng' => $this->lng
            ],
        ];
    }
}
