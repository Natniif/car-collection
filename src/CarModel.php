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
            $new_car = new Car($car["name"], $car["year-made"], $car["zero-sixty"], $car["price"], $car["brand"]);
            $cars_ret[] = $new_car;
        }

        return $cars_ret;
    }
}
