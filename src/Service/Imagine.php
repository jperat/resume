<?php

namespace App\Service;

use Imagine\Image\ImagineInterface;

class Imagine
{
    public function getImagine(): ImagineInterface
    {
        return new \Imagine\Imagick\Imagine();
    }
}
