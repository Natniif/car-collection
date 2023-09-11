<?php

function make_db(): PDO
{
    $db = new PDO('mysql:host=db; dbname=car-collection', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function create_list_of_cars(array $cars): void
{
    foreach ($cars as $car) {
        echo "<h3>" . $car["name"] . "</h3>";
        echo "<ul>";
        echo "<li>" . $car["year-made"] . "</li>";
        echo "<li>" . $car["zero-sixty"] . "</li>";
        echo "<li>" . $car["price"] . "</li>";
        echo "<li>" . $car["brand"] . "</li>";
        echo "</ul>";
    }
}
