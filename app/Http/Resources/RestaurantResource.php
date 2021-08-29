<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "phone_restaurant" => $this->phone_restaurant,
            "state" => $this->state,
            "minimum" => $this->minimum,
            // "image_restaurant"=> $this->image_restaurant,
            // "image"=> $this->image,
            "whats_app" => $this->whats_app,
            "delivery_fee" => $this->delivery_fee,
            "district_id" => $this->district_id,
            "categories_id" => $this->categories->pluck("id")



        ];
    }
}
