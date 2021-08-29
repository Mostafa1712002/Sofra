<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "id"=> $this->id,
            "name"=> $this->name,
            "description"=> $this->description,
            "price"=> $this->price,
            "price_offer"=> $this->price_offer,
            "image" => $this->image,
            "request_time"=> $this->request_time,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "restaurant"=> $this->restaurant->name,

        ];
    }
}
