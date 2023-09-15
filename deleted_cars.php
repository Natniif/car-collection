<?php
session_start();

require_once "src/utils.php";
require_once "vendor/autoload.php";

use CarStore\CarModel;

$model = new CarModel(make_db());
$cars = $model->getAllCarInfo($deleted = true);
$car_list = create_list_of_cars($cars, $deleted = true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if (!empty($car_list)) {
        echo $car_list;
    } else {
        echo "No cars are deleted";
    }
    ?>


</body>

</html>