<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ClientResource extends JsonResource
{



    /**
     * Transform the resource collection into an array.
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
            // "image" => $this->image,
            "district_id" => $this->district_id,
        ];
    }
}
