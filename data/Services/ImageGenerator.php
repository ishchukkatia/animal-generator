<?php

namespace App\Services;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class ImageGenerator
{
    public static function isImageExist(string $path): bool
    {
        return file_exists($path);
    }

    public static function generateImage(string $headPath, string $bodyPath, string $babyImagePath)
    {
        Image::load($bodyPath)
            ->watermark($headPath)
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_LEFT)
            ->watermarkPadding(5, 35, Manipulations::UNIT_PERCENT)
            ->save($babyImagePath);
    }
}
