<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "name" => $this->name,
            "phone" => $this->phone,
            "roles" => $this->roles,
            "2d_comission" => $this["2d_comission"],
            "3d_comission" => $this["3d_comission"],
            "2d_odds" => $this["2d_odds"],
            "3d_odds" => $this["3d_odds"],
            "isEdit" => false,
        ];
    }
}
