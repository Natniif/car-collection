<?php

require_once "vendor/autoload.php";
require_once "src/utils.php";

use CarStore\CarModel;

$model = new CarModel(make_db());
$cars = $model->getAllCars();

$car_list = create_list_of_cars($cars);

// initialise error messages
$err_msg = "";
$out = true;

if (isset($_POST["car_name"])) {
    $car_name = $_POST["car_name"];

    if (is_string($car_name) && strlen($car_name) <= 30 && !empty($car_name)) {
        $method = new CarModel(make_db());
        $out = $method->deleteCarByName($car_name);
    } else {
        $err_msg = "Invalid name";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Car Collection</title>

    <meta name="description" content="Template HTML file">
    <meta name="author" content="iO Academy">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <link rel="icon" href="images/favicon.png" sizes="192x192">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon.png">

    <script defer src="js/index.js"></script>
</head>

<body>

    <header class="header">
        <h2>Home</h2>
        <form method="POST" action="add_car.php">
            <input type="submit" value="Add Car">
        </form>
    </header>


    <form method="POST">

        <?php
        echo $err_msg;
        if (!$out) {
            echo "Name not found";
        }
        ?>
        <h3>Delete a car</h3>
        <p>Insert the name of the car that you wish to delete from the collection below</p>
        <label for="car_name"></label>
        <input type="text" name="car_name" id="car_name_input">
        <input type="submit">
    </form>

    <?php
    echo $car_list;
    ?>
</body>

</html>