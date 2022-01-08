<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait Base64
{
    public function uploadBase64($base64String, $type, $exitedImage)
    {
        // ==== if it's link return that filename substr from that link ====
        if ($this->_isLink($base64String)) {
            $filename = substr($base64String, 37);
            return $filename;
        }
        if ($type === "add") {
            return $this->addImage($base64String);
        } else {
            $this->deleteExitImage($exitedImage);
            return $this->addImage($base64String);
        }
    }

    // ==== checking param is link or base64 string ====
    private function _isLink($url)
    {
        $http = substr($url, 0, 4);
        if (strtolower($http) == "http") {
            return true;
        }
        return false;
    }
    /**
     * add new image
     */
    public function addImage($base64String)
    {
        // ==== else return file name ====
        list($type, $data) = explode(";", $base64String);
        list(, $data) = explode(",", $data);
        list(, $extension) = explode("/", $type);
        $filename = time() . uniqid() . rand(1000, 9999) . "." . 'webp';
        $image = base64_decode($data);
        $image = Image::make($image)->encode('webp', 90)->resize(200, 250);
        Storage::disk("public")->put(
            "images/" . $filename,
            $image,
            "public"
        );
        return $filename;
    }
    /**
     * delete exist image
     */
    public function deleteExitImage($deleteImage)
    {
        $filename = substr($deleteImage, 37);
        $isExit = Storage::disk("public")->exists("/images/" . $filename);
        if ($isExit) {
            Storage::disk("public")->delete("/images/" . $filename);
        }
        return;
    }
}
