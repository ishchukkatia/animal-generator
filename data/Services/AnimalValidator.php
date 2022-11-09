<?php

namespace App\Services;

class AnimalValidator
{
    public function validate(array $characteristics)
    {
        if(empty($characteristics['sex'])) {
            throw new \Exception('choose sex');
        }
        if (empty($characteristics['type'])) {
            throw new \Exception('choose type');
        }
        if (empty($characteristics['place'])) {
            throw new \Exception('choose place');
        }
        if (empty($characteristics['color'])) {
            throw new \Exception('choose color');
        }
        if (empty($characteristics['size'])) {
            throw new \Exception('choose size');
        }
    }
}