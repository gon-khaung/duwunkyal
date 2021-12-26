<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "is_featured" => "boolean",
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy("created_at", "desc");
    }
}
