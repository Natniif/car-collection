<?php

require_once "vendor/autoload.php";
require_once "src/utils.php";

use CarStore\CarModel;
use CarStore\Car;

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

    $validate = validateDataFields($car);

    if ($validate == false) {
        return;
    }

    $model = new CarModel(make_db());

    $success = $model->addCar($car);
    if ($success == false) {
        echo "<strong>Database query failed, check inputted values</strong>";
        return;
    }
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
            <input type="text" name="name" id="name" required />
        </div>
        <div>
            <label for="year_made">Year Made</label>
            <input type="number" name="year_made" id="year" required />
        </div>
        <div>
            <label for="zero_sixty">Zero to Sixty</label>
            <input type="text" name="zero_sixty" id="zero_sixty" required />
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" required />
        </div>
        <div>
            <label for="brand">Car Brand Name</label>
            <input type="text" name="brand" id="brand" required />
        </div>

        <div>
            <input type="submit" />
        </div>
    </form>

</body>

</html>