<?php

namespace App\Controllers;

use App\Configs\AnimalConfig;
use App\Entities\Animal;
use App\Services\ImageGenerator;

class AnimalGeneratorController
{
    public function generate(array $firstParentData, array $secondParentData)
    {
        $firstParentClass = AnimalConfig::ANIMAL_NAMESPACES[$firstParentData['animal']];
        $secondParentClass = AnimalConfig::ANIMAL_NAMESPACES[$secondParentData['animal']];
        $firstParent = new $firstParentClass($firstParentData['size'], $firstParentData['color'], $firstParentData['place'], $firstParentData['sex'], $firstParentData['type']);
        $secondParent = new $secondParentClass($secondParentData['size'], $secondParentData['color'], $secondParentData['place'], $secondParentData['sex'], $secondParentData['type']);

        return $this->generateAnimal( $firstParent , $secondParent);
    }

    /**
     * @param Animal $firstParent
     * @param Animal $secondParent
     * @return Animal
     * @throws \Exception
     */
    private function generateAnimal(Animal $firstParent, Animal $secondParent): Animal
    {
        if ($firstParent->getSex() === $secondParent->getSex()) {
            throw new \Exception('parents have similar sex');
        }
        if ($firstParent->getPlace() !== $secondParent->getPlace()) {
            throw new \Exception('parents have different place');
        }
        if ($firstParent->getSize() !== $secondParent->getSize()) {
            throw new \Exception('parents have different size');
        }
        $name = $this->generateName($firstParent, $secondParent);
        $size = $this->generateSize($firstParent, $secondParent);
        $place = $this->generatePlace($firstParent, $secondParent);
        $color = $this->generateColor($firstParent, $secondParent);
        $type = $this->generateType($firstParent, $secondParent);
        $sex = $this->generateSex($firstParent, $secondParent);
        $child = new Animal($size, $color, $place, $sex, $type);
        $child->setName($name);

        if(!ImageGenerator::isImageExist($child->getBabyImage())){
            ImageGenerator::generateImage($secondParent->getHeadImage(), $firstParent->getBodyImage(), $child->getBabyImage());
        }

        return $child;
    }

    private function generateName(Animal $firstParent, Animal $secondParent)
    {
        return substr($firstParent->getName(), 0, 2) . substr($secondParent->getName(), -2, 2);
    }

    private function generateSize(Animal $firstParent, Animal $secondParent)
    {
        $size = [$firstParent->getSize(), $secondParent->getSize()];
        shuffle($size);
        return $size[0];
    }

    private function generatePlace(Animal $firstParent, Animal $secondParent)
    {
        $place = [$firstParent->getPlace(), $secondParent->getPlace()];
        shuffle($place);
        return $place[0];
    }

    private function generateType(Animal $firstParent, Animal $secondParent)
    {
        $type = [$firstParent->getType(), $secondParent->getType()];
        shuffle($type);
        return $type[0];
    }

    private function generateColor(Animal $firstParent, Animal $secondParent)
    {
        $color = [$firstParent->getColor(), $secondParent->getColor()];
        shuffle($color);
        return $color[0];
    }

    private function generateSex(Animal $firstParent, Animal $secondParent)
    {
        $sex = [$firstParent->getSex(), $secondParent->getSex()];
        shuffle($sex);
        return $sex[0];
    }


}
