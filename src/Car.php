<?php

namespace CarStore;

readonly class Car
{
    public ?int $id;
    public ?string $name;
    public ?int $year_made;
    public ?float $zero_sixty;
    public ?float $price;
    public ?string $brand;

    public function __construct(?int $id, ?string $name = NULL, ?int $year_made = NULL, ?float $zero_sixty = NULL, ?float $price = NULL, ?string $brand = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->year_made = $year_made;
        $this->zero_sixty = $zero_sixty;
        $this->price = $price;
        $this->brand = $brand;
    }
}
