<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            "full_name" => $this->full_name,
            "email" => $this->email,
            "type" => $this->type,
            "message" => $this->message,
            "phone" => $this->phone,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,

        ];
    }
}
