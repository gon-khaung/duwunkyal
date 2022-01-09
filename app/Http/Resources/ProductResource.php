<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\DynamicName;
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
        $colors = DynamicName::wherein("id", $this->colors)->pluck("name");
        $sizes = DynamicName::wherein("id", $this->sizes)->pluck("name");
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "is_instock" => $this->is_instock,
            "is_featured" => $this->is_featured,
            "price" => $this->price,
            "image" => $this->image,
            "color_names" => $colors,
            "size_names" => $sizes,
            "colors" => $this->colors,
            "sizes" => $this->sizes,
            "category_id" => $this->category_id,
            "category" => Category::find($this->category_id)->name,
        ];
    }
}
