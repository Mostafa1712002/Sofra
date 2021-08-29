<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AllRestaurantResource extends JsonResource
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
            "id" => $this->id,

            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "phone_restaurant" => $this->phone_restaurant,
            "whats_app" => $this->whats_app,
            "state" => $this->state,
            "minimum" => $this->minium,
            "image_restaurant" => $this->image_restaurant,
            "image" => $this->image,
            "delivery_fee" => $this->delivery_fee,
            "district_id" => $this->district->name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "comments" => $this->comments,
        ];
    }
}
