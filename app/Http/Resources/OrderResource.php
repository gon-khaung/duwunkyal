<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "name" => User::find($this->user_id)->name,
            "address" => $this->address,
            "note" => $this->note,
            "phone" => $this->phone,
            "status" => $this->status,
            "total" => $this->total
        ];
    }
}
