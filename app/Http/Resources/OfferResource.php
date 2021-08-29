<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            "image" => $this->image,
            "description" =>  $this->description,
            "date_to" => $this->date_to,
            "date_from" => $this->date_from,
            "restaurant" => Restaurant::where("id",$this->restaurant_id)->first()->name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
