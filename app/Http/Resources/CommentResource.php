<?php

namespace App\Http\Resources;

use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "content" => $this->content,
            "rating" => $this->rating,
            "client" => Client::where("id",$this->client_id)->first()->name,
            "restaurant" => Restaurant::where("id",$this->restaurant_id)->first()->name,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
