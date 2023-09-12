<?php

use CarStore\Car;

function make_db(): PDO
{
    $db = new PDO('mysql:host=db; dbname=car-collection', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function create_list_of_cars(array $cars): string | false
{
    foreach ($cars as $car) {
        if (!($car instanceof Car)) {
            return false;
        }
    }

    if (empty($cars)) {
        throw new Error("Empty car array");
    }

    $ret = "";

    foreach ($cars as $car) {
        $ret .= "<h3>" . $car->name . "</h3>";
        $ret .= "<ul>";
        $ret .= "<li>" . $car->year_made . "</li>";
        $ret .= "<li>" . $car->zero_sixty . "</li>";
        $ret .= "<li>" . $car->price . "</li>";
        $ret .= "<li>" . $car->brand . "</li>";
        $ret .= "</ul>";
    }

    return $ret;
}

function validateDataFields(Car $car): bool
{
    $ret = true;

    if (
        empty($car->name) == true ||
        strlen($car->name) > 30 ||
        strlen($car->name) <= 0
    ) {
        echo "Name cannot be over 30 characters long" . "<br>";
        $ret = false;
    }

    if (
        empty($car->year_made) == true ||
        is_int($car->year_made) == false ||
        strlen(strval($car->year_made)) <= 0 ||
        strlen(strval($car->year_made)) > 4 ||
        $car->year_made < 0 ||
        $car->year_made > 2023
    ) {
        echo "Invalid year" . "<br>";
        $ret = false;
    }

    if (
        empty($car->zero_sixty) == true ||
        is_int($car->zero_sixty) == false ||
        $car->zero_sixty <= 0
    ) {
        echo "Invalid zero to sixty value" . "<br>";
        $ret = false;
    }

    if (
        empty($car->price) == true ||
        is_int($car->price) == false ||
        $car->price <= 0
    ) {
        echo "Invalid price" . "<br>";
        $ret = false;
    }

    if (
        empty($car->brand) == true ||
        strlen($car->brand) >= 20 ||
        strlen($car->brand) <= 0
    ) {
        echo "Brand name cannot be over 20 characters" . "<br>";
        $ret = false;
    }
    return $ret;
}
