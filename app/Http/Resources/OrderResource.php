<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "address"=> $this->address,
            "payment_method"=> $this->cash,
            "state"=> $this->state,
            "client_id"=> $this->client_id,
            "restaurant_id"=> $this->restaurant_id,
            "cost"=> $this->cost,
            "delivery_cost"=> $this->delivery_cost,
            "total"=> $this->total,
            "commission"=> $this->commission,
            "net"=> $this->net,
            "notes"=> $this->notes,
            "insert_time" => $this->insert_time,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
