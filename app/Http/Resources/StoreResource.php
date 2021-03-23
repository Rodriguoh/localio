<?php

namespace App\Http\Resources;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'description' => $this->description,
            'category' => $this->category->label,
            'url' => $this->url,
            'phone' => $this->phone,
            'mail' => $this->mail,
            'SIRET' => $this->SIRET,
            'thumbnails' => $this->photos()->first()->url ?? '',
            'avg_note' => Comment::where('store_id', $this->id)->avg('note'),
            'adresse' => [
                'number' => $this->number,
                'street' => $this->street,
                'city' => $this->city->name,
                'ZIPCode' => $this->city->ZIPCode,
            ],
            'isDelivering' => $this->delivery,
            'conditionDelivery' => $this->conditionDelivery,
            'openingHours' => $this->openingHours,
            'product' => $this->products,
        ];
    }
}
