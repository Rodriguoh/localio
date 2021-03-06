<?php

namespace App\Http\Resources;

use App\Models\Comment;

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
            'short_description' => $this->short_description,
            'category_id' => $this->category->category_id == null ? $this->category->id : $this->category->category_id,
            'category' => $this->category->label,
            'thumbnails' => $this->photos()->first()->url ?? '',
            'avg_note' => Comment::where([['store_id', $this->id],])
            ->avg('note'),
            'nb_comment' => Comment::where([['store_id', $this->id],])
            ->count(),
            'latnlg' => [
                'lat' => $this->lat,
                'lng' => $this->lng
            ],
        ];
    }
}
