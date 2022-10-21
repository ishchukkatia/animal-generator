<?php

namespace App\Controllers;

use App\Entities\Animal;
use App\Entities\Cat;
use App\Entities\Dog;

class AnimalGeneratorController
{
    public function index()
    {
        try {
            $cat = new Cat('middle', 'black', 'house', 'man', 'porodustuy');
            $dog = new Dog('middle', 'brown', 'house', 'woman', 'porodustuy');
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $this->generateAnimal($cat, $dog);
    }

    private function generateAnimal(Animal $firstParent, Animal $secondParent)
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
        $this->generateName($firstParent, $secondParent);
    }

    private function generateName(Animal $object1, Animal $object2)
    {
        $reflectionFirstObject = new \ReflectionClass($object1);
        $reflectionSecondObject = new \ReflectionClass($object2);

        return substr($reflectionFirstObject->getShortName(), 0, 2) . substr($reflectionSecondObject->getShortName(), -2, 2);
    }
}