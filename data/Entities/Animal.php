<?php

namespace App\Entities;

use http\Exception;

abstract class Animal
{
    protected const PLACE_VALUES = ['sky', 'mountain', 'sea', 'earth', 'river', 'house', 'tree'];
    protected const SEX_VALUES = ['man', 'woman'];
    protected const COLOR_VALUES = ['black', 'red', 'blue', 'gray', 'gold', 'brown', 'green', 'white'];
    protected const TYPE_VALUES = ['vodni', 'syxopytni', 'dvornaga', 'porodustuy', 'zumovuy', 'litniy', 'istuvna', 'vecoratuvna'];
    protected const SIZE_VALUES = ['big', 'middle', 'small'];

    protected string $sex;
    protected string $size;
    protected string $type;
    protected string $color;
    protected string $place;

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $value
     * @return void
     * @throws \Exception
     */
    protected function setPlace(string $value): void
    {
        if (!in_array($value, self::PLACE_VALUES)) {
            throw new \Exception('incorrect place');
        }

        $this->place = $value;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     * @throws \Exception
     */
    protected function setSex(string $sex): void
    {

        if (!in_array($sex, self::SEX_VALUES)) {
            throw new \Exception('incorrect sex');

        }

        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @throws \Exception
     */
    protected function setSize(string $size): void
    {
        if (!in_array($size, self::SIZE_VALUES)) {
            throw new \Exception('incorrect size');
        }

        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @throws \Exception
     */
    protected function setType(string $type): void
    {
        if (!in_array($type, self::TYPE_VALUES)) {
            throw new \Exception('incorrect type');
        }

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @throws \Exception
     */
    protected function setColor(string $color): void
    {
        if (!in_array($color, self::COLOR_VALUES)) {
            throw new \Exception('incorrect color');
        }

        $this->color = $color;
    }

    public function __construct(string $size, string $color, string $place, string $sex, string $type)
    {
        $this->setPlace($place);
        $this->setColor($color);
        $this->setSex($sex);
        $this->setSize($size);
        $this->setType($type);
    }
}

