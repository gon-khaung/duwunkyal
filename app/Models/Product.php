<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        "image" => Image::class,
    ];
}
