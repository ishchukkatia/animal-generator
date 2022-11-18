<?php

namespace App\Models;

use App\Entities\Animal;
use mysqli;

class AnimalModel
{
    private $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli('mysql', 'root', 'root', 'animal_generator');
    }

    public function getAnimals()
    {
        return $this->connection->query("
            SELECT * FROM animals ORDER BY created_at DESC LIMIT 10
        ");
    }

    public function saveAnimal(Animal $animal)
    {
        $this->connection->query("
            INSERT INTO animals (`name`, `sex`, `type`, `color`, `place`, `size`, `image_path`, `created_at`) 
            VALUES ('{$animal->getName()}','{$animal->getSex()}', '{$animal->getType()}', '{$animal->getColor()}', '{$animal->getPlace()}', '{$animal->getSize()}', '{$animal->getBabyImage()}', now())
        ");
    }


}