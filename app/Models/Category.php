<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "is_featured" => "boolean",
        "image" => Image::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy("created_at", "desc");
    }
}
