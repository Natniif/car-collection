<?php

require_once "src/utils.php";
require_once "vendor/autoload.php";

use CarStore\CarModel;

$model = new CarModel(make_db());

$model->deleteCarById($_POST['restore_id'], $restore = true);

header("Location: deleted_cars.php");
exit();
