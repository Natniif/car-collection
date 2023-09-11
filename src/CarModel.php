<?php

namespace CarStore;

require_once "vendor/autoload.php";


use CarStore\Car;

use PDO;

class CarModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCars(): array
    {
        $query = $this->db->prepare("SELECT `name`, `year-made`, `zero-sixty`, `price`, `brand` FROM `cars`");
        $query->execute();
        $cars = $query->fetchAll();

        $cars_ret = [];

        foreach ($cars as $car) {
            $cars_ret[] = new Car($car["name"], $car["year-made"], $car["zero-sixty"], $car["price"], $car["brand"]);
        }

        return $cars_ret;
    }
}
