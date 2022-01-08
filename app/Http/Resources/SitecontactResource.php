<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SitecontactResource extends JsonResource
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
            "phone" => $this->phone,
            "address" => $this->address,
            "email" => $this->email,
            "isEdit" => false,
            "open_time" => $this->open_time
        ];
    }
}
