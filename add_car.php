<?php

require_once "../vendor/autoload.php";
require_once "utils.php";

use CarStore\UpdateCars;
use CarStore\Car;

if (
    isset($_POST["name"]) &&
    isset($_POST["year-made"]) &&
    isset($_POST["zero-sixty"]) &&
    isset($_POST["price"]) &&
    isset($_POST["brand"])
) {

    $name = $_POST["name"];
    $year_made = $_POST["year-made"];
    $zero_sixty = $_POST["zero-sixty"];
    $price = $_POST["price"];
    $brand = $_POST["brand"];

    $car = new Car($name, $year_made, $zero_sixty, $price, $brand);
    var_dump($car);

    $user = new UpdateCars(make_db());
    $user->addCar($car);
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

    <form method="POST">
        <h1>Add a Car</h1>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="year-made">Year Made</label>
            <input type="text" name="year-made" id="year">
        </div>
        <div>
            <label for="zero-sixty">Zero to Sixty</label>
            <input type="text" name="zero-sixty" id="zero-sixty">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="pricr" id="price">
        </div>
        <div>
            <label for="brand">Car Brand Name</label>
            <input type="text" name="brand" id="brand">
        </div>

        <div>
            <input type="submit">
        </div>
    </form>


</body>

</html>