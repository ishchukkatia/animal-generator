<?php

namespace App\Configs;

use App\Entities\Bird;
use App\Entities\Cat;
use App\Entities\Dog;
use App\Entities\Fish;
use App\Entities\Turtle;

class AnimalConfig
{
    public const ANIMALS = ['cat', 'dog', 'fish', 'bird', 'turtle'];
    public const CHARACTERISTICS = [
        'cat' => [
            'sex' => ['man', 'woman'],
            'place' => ['earth', 'house', 'tree'],
            'color' => ['black', 'red', 'gray', 'brown', 'white'],
            'type' => ['dvornaga', 'porodustuy'],
            'size' => ['middle', 'small']
        ],
        'dog' => [
            'sex' => ['man', 'woman'],
            'place' => ['earth', 'house'],
            'color' => ['black', 'red', 'gray', 'brown', 'white'],
            'type' => ['dvornaga', 'porodustuy'],
            'size' => ['middle', 'big']

        ],
        'fish' => [
            'sex' => ['man', 'woman'],
            'place' => ['sea', 'river'],
            'color' => ['blue', 'gray', 'gold', 'green'],
            'type' => ['istuvna', 'vecoratuvna'],
            'size' => ['middle', 'small']
        ],
        'bird' => [
            'sex' => ['man', 'woman'],
            'place' => ['sky', 'mountain', 'tree'],
            'color' => ['black', 'gray', 'brown', 'white'],
            'type' => ['zumovuy', 'litniy'],
            'size' => ['small']
        ],
        'turtle' => [
            'sex' => ['man', 'woman'],
            'place' => ['sea', 'earth', 'river'],
            'color' => ['gray', 'green'],
            'type' => ['vodni', 'syxopytni'],
            'size' => ['big', 'middle', 'small']
        ]

    ];
    public const ANIMAL_NAMESPACES = [
        'cat' => Cat::class,
        'dog' => Dog::class,
        'fish' => Fish::class,
        'bird' => Bird::class,
        'turtle' => Turtle::class
    ];
}