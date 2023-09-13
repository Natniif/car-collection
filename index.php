<?php

require_once "vendor/autoload.php";
require_once "src/utils.php";

use CarStore\CarModel;

$model = new CarModel(make_db());
$cars = $model->getAllCarInfo();

$car_list = create_list_of_cars($cars);

// initialise error messages
$err_msg = "";
$out = true;

if (isset($_POST["car_name"])) {
    $car_name = $_POST["car_name"];

    if (is_string($car_name) && strlen($car_name) <= 30 && !empty($car_name)) {
        $method = new CarModel(make_db());
        $id = $method->getIdFromName($car_name);
        $out = $method->deleteCarById($id);
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


        <h3>Delete a car</h3>
        <?php
        echo $err_msg;
        if (!$out) {
            echo "Name not found";
        }
        ?>
        <p>Insert the name of the car that you wish to delete from the collection below</p>
        <label for="car_name"></label>
        <input type="text" name="car_name" id="car_name_input">
        <input type="submit">
    </form>

    <?php
    echo $car_list;
    ?>

    <h3>Edit a cars details</h3>
    <p>Please enter the cars name you want to edit and fill out at least one of the other fields to edit</p>

    <form method="POST">
        <?php

        use CarStore\Car;

        if (isset($_POST["name_edit"])) {

            $car_name_edit = $_POST["name_edit"];
            $year_made_edit = $_POST["year_made_edit"];
            $zero_sixty_edit = $_POST["zero_sixty_edit"];
            $price_edit = $_POST["price_edit"];
            $brand_edit = $_POST["brand_edit"];


            $method = new CarModel(make_db());

            if (!empty($year_made_edit) || !empty($zero_sixty_edit) || !empty($price_edit) || !empty($brand_edit)) {
                if ($method->searchForName($car_name_edit)) {
                    $car = new Car($car_name_edit, (int)$year_made_edit, (float)$zero_sixty_edit, (float)$price_edit, $brand_edit);
                    $out = $method->editCarDetails($car);
                } else {
                    echo "Unable to edit car details, please check inputted values and try again";
                }
            } else {
                echo "Please fill out one of the fields to edit";
            }
        }
        ?>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name_edit" id="name" required />
        </div>
        <div>
            <label for="year_made">Year Made</label>
            <input type="number" name="year_made_edit" id="year" />
        </div>
        <div>
            <label for="zero_sixty">Zero to Sixty</label>
            <input type="text" name="zero_sixty_edit" id="zero_sixty" />
        </div>
        <div>
            <label for="price">Price</label>
            <input type="text" name="price_edit" id="price" />
        </div>
        <div>
            <label for="brand">Car Brand Name</label>
            <input type="text" name="brand_edit" id="brand" />
        </div>

        <div>
            <input type="submit" />
        </div>
    </form>

</body>

</html>