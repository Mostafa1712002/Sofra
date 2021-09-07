<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class notificationResource extends JsonResource
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
            "title" => $this->title,
            "content" => $this->content,
            "order_id" => $this->order_id,
            "is_read" => $this->is_read,
            "created_at" => $this->created_at,
            "updated_ate" => $this->updated_ate
        ];
    }
}
