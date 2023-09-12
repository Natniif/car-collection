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
        $query = $this->db->prepare("SELECT `name`, `year_made`, `zero_sixty`, `price`, `brand` FROM `cars` WHERE `deleted` = 0");
        $query->execute();
        $cars = $query->fetchAll();

        $cars_ret = [];

        foreach ($cars as $car) {
            $cars_ret[] = new Car($car["name"], $car["year_made"], $car["zero_sixty"], $car["price"], $car["brand"]);
        }

        return $cars_ret;
    }
}
