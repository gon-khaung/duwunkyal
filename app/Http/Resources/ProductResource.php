<?php

namespace App\Http\Resources;

use App\Models\DynamicName;
use App\Models\Subproduct;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $colors = DynamicName::wherein('id', json_decode($this->colors, true))->pluck('name');
        $sizes = DynamicName::wherein('id', json_decode($this->sizes, true))->pluck('name');
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "is_instock" => $this->is_instock,
            "is_featured" => $this->is_featured,
            "price" => $this->price,
            "image" => $this->image,
            'colors' => $colors,
            "sizes" => $sizes,
            "category_id" => $this->category_id
        ];
    }
}
