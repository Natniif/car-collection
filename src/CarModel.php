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
        $query = $this->db->prepare("SELECT `name`, `year_made`, `zero_sixty`, `price`, `brand` FROM `cars`");
        $query->execute();
        $cars = $query->fetchAll();

        $cars_ret = [];

        foreach ($cars as $car) {
            $cars_ret[] = new Car($car["name"], $car["year_made"], $car["zero_sixty"], $car["price"], $car["brand"]);
        }

        return $cars_ret;
    }

    public function addCar(Car $car): bool
    {

        $query = $this->db->prepare("INSERT INTO `cars`
        (`name`, `year_made`, `zero_sixty`, `price`, `brand`, `deleted`)
        VALUES (:car_name, :year_made, :zero_sixty, :price, :brand , 0);");
        $query->execute([
            'car_name' => $car->name,
            'year_made' => $car->year_made,
            'zero_sixty' => $car->zero_sixty,
            'price' => $car->price,
            'brand' => $car->brand
        ]);

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
