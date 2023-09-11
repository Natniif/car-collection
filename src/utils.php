<?php

use CarStore\Car;

function make_db(): PDO
{
    $db = new PDO('mysql:host=db; dbname=car-collection', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function create_list_of_cars(array $cars): string
{
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
