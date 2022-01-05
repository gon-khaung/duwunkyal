<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
    ];

    public function subproducts()
    {
        return $this->hasMany(Subproduct::class)->orderBy("created_at", "desc");
    }
}
