<?php

namespace App\Entities;

class Dog extends  Animal
{
    const PLACE_VALUES = ['earth', 'house'];
    const SEX_VALUES = ['man', 'woman'];
    const COLOR_VALUES = ['black', 'red', 'gray', 'brown', 'white'];
    const TYPE_VALUES = ['dvornaga', 'porodustuy'];
    const SIZE_VALUES = ['middle', 'big'];
    protected const NAME = 'dog';
}