<?php

namespace CarStore;

readonly class Car
{
    public string $name;
    public int $year_made;
    public float $zero_sixty;
    public float $price;
    public string $brand;

    public function __construct(string $name, int $year_made, float $zero_sixty, float $price, string $brand)
    {
        $this->name = $name;
        $this->year_made = $year_made;
        $this->zero_sixty = $zero_sixty;
        $this->price = $price;
        $this->brand = $brand;
    }
}
