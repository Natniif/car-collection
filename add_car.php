<?php

require_once "vendor/autoload.php";
require_once "src/utils.php";

use CarStore\UpdateCars;
use CarStore\Car;

session_start();

// var_dump($_POST);

if (
    isset($_POST["name"]) &&
    isset($_POST["year_made"]) &&
    isset($_POST["zero_sixty"]) &&
    isset($_POST["price"]) &&
    isset($_POST["brand"])
) {
    $name = $_POST["name"];
    $year_made = $_POST["year_made"];
    $zero_sixty = $_POST["zero_sixty"];
    $price = $_POST["price"];
    $brand = $_POST["brand"];

    $car = new Car($name, $year_made, $zero_sixty, $price, $brand);

    $user = new UpdateCars(make_db());
    $user->addCar($car);
} else {
    echo "All fields are required";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
</head>

<body>

    <h1>Add a Car</h1>
    <form method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" />
        </div>
        <div>
            <label for="year_made">Year Made</label>
            <input type="text" name="year_made" id="year" />
        </div>
        <div>
            <label for="zero_sixty">Zero to Sixty</label>
            <input type="text" name="zero_sixty" id="zero_sixty" />
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" />
        </div>
        <div>
            <label for="brand">Car Brand Name</label>
            <input type="text" name="brand" id="brand" />
        </div>

        <div>
            <input type="submit" />
        </div>
    </form>


</body>

</html>