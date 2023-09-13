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

function validateDataFields(string $name, int $year_made, float $zero_sixty, float $price, string $brand): string
{
    $err_msg = "";
    if (
        !is_string($name) ||
        empty($name) ||
        strlen($name) > 30 ||
        strlen($name) <= 0
    ) {
        $err_msg .= "Invalid name" . "<br>";
    }


    if (
        empty($year_made) ||
        !is_numeric($year_made) ||
        strlen(strval($year_made)) <= 0 ||
        strlen(strval($year_made)) > 4 ||
        $year_made < 0 ||
        $year_made > 2023
    ) {
        $err_msg .= "Invalid year" . "<br>";
    }


    if (
        empty($zero_sixty) ||
        !is_numeric($zero_sixty) ||
        $zero_sixty <= 0
    ) {
        $err_msg .= "Invalid zero to sixty value" . "<br>";
    }


    if (
        empty($price) ||
        !is_numeric($price) ||
        $price <= 0
    ) {
        $err_msg .= "Invalid price" . "<br>";
    }


    if (
        !is_string($brand) ||
        empty($brand) ||
        strlen($brand) >= 20 ||
        strlen($brand) <= 0
    ) {
        $err_msg .= "Invalid brand name" . "<br>";
    }

    if (strlen($err_msg) == 0) {
        return "Car successfully submitted";
    }
    return $err_msg;
}
