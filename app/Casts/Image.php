<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Image implements CastsAttributes
{
    /**
     * Add path to the value array(with loop) or string from storage.
     */
    public function get($model, $key, $value, $attributes)
    {
        $path = "https://duwunkyal.org/storage/images/";
        if ($value) {
            return $path . $value;
        }
        return null;
    }

    /**
     * Set the value directly to the storage.
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
