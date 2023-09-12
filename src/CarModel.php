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
        $query = $this->db->prepare(
            "SELECT `name`, `year_made`, `zero_sixty`, `price`, `brand` FROM `cars` WHERE `deleted` = 0"
        );
        $query->execute();
        $cars = $query->fetchAll();

        $cars_ret = [];

        foreach ($cars as $car) {
            $cars_ret[] = new Car($car["name"], $car["year_made"], $car["zero_sixty"], $car["price"], $car["brand"]);
        }

        return $cars_ret;
    }

    public function getAllCarNames(): array | false
    {
        $query = $this->db->prepare("SELECT `name` FROM `cars` WHERE `deleted` = 0;");
        $query->execute();
        $array_of_names = $query->fetchAll();
        $names = [];
        foreach ($array_of_names as $name) {
            $names[] = $name["name"];
        }
        return $names;
    }

    public function addCar(Car $car): bool
    {
        if (!in_array($car->name, $this->getAllCarNames())) {
            $query = $this->db->prepare("INSERT INTO `cars`
                (`name`, `year_made`, `zero_sixty`, `price`, `brand`, `deleted`)
                VALUES (:car_name, :year_made, :zero_sixty, :price, :brand , 0);");
            return $query->execute([
                'car_name' => $car->name,
                'year_made' => $car->year_made,
                'zero_sixty' => $car->zero_sixty,
                'price' => $car->price,
                'brand' => $car->brand
            ]);
        }
    }

    public function getIdFromName(string $name): string | false
    {
        $query = $this->db->prepare("SELECT `id` FROM `cars` WHERE `name` = :name;");
        $query->bindParam('name', $name);
        $query->execute();
        $id_array = $query->fetch();
        return $id_array["id"];
    }

    public function getNameFromId(string $id): string | false
    {
        $query = $this->db->prepare("SELECT `name` FROM `cars` WHERE `id` = :id;");
        $query->bindParam('id', $id);
        $query->execute();
        $name_array = $query->fetch();
        return $name_array["name"];
    }

    public function searchForName(string $carname): array | false
    {
        $query = $this->db->prepare("SELECT `name` FROM `cars` WHERE `name` = :name;");
        $query->bindParam('name', $carname);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteCarById(string $id): bool
    {
        $carname = $this->getNameFromId($id);
        if (!empty($this->searchForName($carname))) {
            $query = $this->db->prepare("UPDATE `cars` SET `deleted` = 1 WHERE `id` = :id;");
            $query->bindParam('id', $id);

            return $query->execute();
        } else {
            return false;
        }
    }
}
