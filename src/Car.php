<?php

namespace CarStore;

require_once 'vendor/autoload.php';
require_once 'src/utils.php';

use CarStore\CarModel;


readonly class Car
{
    public string $name;
    public int $year_made;
    public float $zero_sixty;
    public float $price;
    public string $brand;
    public int $id;

    public function __construct(?string $name = NULL, ?int $year_made = NULL, ?float $zero_sixty = NULL, ?float $price = NULL, ?string $brand = NULL)
    {
        $this->name = $name;
        $this->year_made = $year_made;
        $this->zero_sixty = $zero_sixty;
        $this->price = $price;
        $this->brand = $brand;

        $method = new CarModel(make_db());
        $this->id = $method->getIdFromName($this->name);
    }
}
