<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
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
            "token" => $this->token,
            "platform" => $this->platform,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
