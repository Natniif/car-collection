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

    public function validateCarBrand($brand): bool
    {
        $query = $this->db->prepare("SELECT `brand` FROM `cars` WHERE `brand` = :brand AND `deleted` = 0;");
        $query->bindParam('brand', $brand);

        $query->execute();
        $ret = $query->fetch();
        if (empty($ret)) {
            return false;
        } else {
            return true;
        }
    }

    private function returnCarsAsNormalArray(array $cars): array
    {
        $cars_ret = [];

        foreach ($cars as $car) {
            $cars_ret[] = new Car($car["id"], $car["name"], $car["year_made"], $car["zero_sixty"], $car["price"], $car["brand"]);
        }

        return $cars_ret;
    }

    public function filterCarBrand($brand): array
    // works like getAllCarInfo but only returns results which match $brand
    {
        $query = $this->db->prepare("SELECT * FROM `cars` WHERE `brand` = :brand;");
        $query->bindParam('brand', $brand);
        $query->execute();
        $cars = $query->fetchAll();
        return $this->returnCarsAsNormalArray($cars);
    }


    public function getAllCarInfo($deleted = false): array
    {
        if (!$deleted) {
            $sql_qry = "SELECT `id`, `name`, `year_made`, `zero_sixty`, `price`, `brand` FROM `cars` WHERE `deleted` = 0;";
        } else {
            $sql_qry = "SELECT `id`, `name`, `year_made`, `zero_sixty`, `price`, `brand` FROM `cars` WHERE `deleted` = 1;";
        }
        $query = $this->db->prepare($sql_qry);
        $query->execute();
        $cars = $query->fetchAll();

        return $this->returnCarsAsNormalArray($cars);
    }

    public function getAllCarNames($deleted = false): array | false
    {
        if (!$deleted) {
            $sql_qry = "SELECT `name` FROM `cars` WHERE `deleted` = 0";
        } else {
            $sql_qry = "SELECT `name` FROM `cars` WHERE `deleted` = 1";
        }
        $query = $this->db->prepare($sql_qry);
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

    public function deleteCarById(string $id): bool
    {
        $carname = $this->getNameFromId($id);
        if (!empty($this->getIdFromName($carname))) {
            $query = $this->db->prepare("UPDATE `cars` SET `deleted` = 1 WHERE `id` = :id;");
            $query->bindParam('id', $id);

            return $query->execute();
        } else {
            return false;
        }
    }

    public function editCarDetails(Car $car): bool
    {
        $sql_qry = "UPDATE `cars` SET ";

        $params = [];
        if ($car->year_made !== NULL && !empty($car->year_made)) {
            $sql_qry .= "`year_made` = :year_made, ";
            $params['year_made'] = $car->year_made;
        }

        if ($car->zero_sixty !== NULL && !empty($car->zero_sixty)) {
            $sql_qry .= "`zero_sixty` = :zero_sixty, ";
            $params['zero_sixty'] = $car->zero_sixty;
        }

        if ($car->price !== NULL && !empty($car->price)) {
            $sql_qry .= "`price` = :price, ";
            $params['price'] = $car->price;
        }

        if ($car->brand !== NULL && !empty($car->brand)) {
            $sql_qry .= "`brand` = :brand, ";
            $params['brand'] = $car->brand;
        }
        $sql_qry = rtrim($sql_qry, ', ');

        $sql_qry .= " WHERE `id` = :id;";
        $params['id'] = $car->id;

        $query = $this->db->prepare($sql_qry);

        return $query->execute($params);
    }
}
