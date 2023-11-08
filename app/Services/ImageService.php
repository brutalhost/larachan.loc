<?php

namespace App\Services;

use Bkwld\Croppa\Facades\Croppa;

class ImageService
{
    public $attributes = [
        'width'  => 32,
        'height' => 32,
        'params' => [],
    ];

    public function get(string $path)
    {
        return Croppa::url($path, $this->attributes['width'], $this->attributes['height'], $this->attributes['params']);
    }

    public function size($width, $height)
    {
        $this->attributes['width']  = $width;
        $this->attributes['height'] = $height;
        return $this;
    }

    public function params($params) {
        $this->attributes['params']  = $params;
        return $this;
    }

    public function smallAvatarSize()
    {
        return $this->size(32, 32);
    }

    public function profileAvatarSize()
    {
        return $this->size(270, null)->params(['resize']);
    }
}
