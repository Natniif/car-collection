<?php

namespace CarStore;

use CarStore\Car;

use PDO;

class UpdateCars
{
    public PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addCar(Car $car): void
    {
        $query = $this->db->prepare("INSERT INTO `cars`
        (`name`, `year-made`, `zero-sixty`, `price`, `brand`)
        VALUES (:car_name, :year_made, :zero-sixty, :price, :brand);");
        $query->execute([
            'car_name' => $car->name,
            'year_made' => $car->year_made,
            'zero-sixty' => $car->zero_sixty,
            'price' => $car->price,
            'brand' => $car->brand
        ]);
    }
}
