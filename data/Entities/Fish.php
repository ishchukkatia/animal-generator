<?php

namespace App\Entities;

class Fish extends  Animal
{
    const PLACE_VALUES = ['sea', 'river'];
    const SEX_VALUES = ['man', 'woman'];
    const COLOR_VALUES = ['blue', 'gray', 'gold', 'green'];
    const TYPE_VALUES = ['istuvna', 'vecoratuvna'];
    const SIZE_VALUES = ['middle', 'small'];
    protected const NAME = 'fish';
}