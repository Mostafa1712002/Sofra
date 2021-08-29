<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            "about_us" => $this->about_us,
            "commission" => $this->commission,
            "num_bank_alahli" => $this->num_bank_alahli,
            "num_bank_alrakhi" => $this->num_bank_alrakhi,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
