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
        <a href="add_book.php">Add book</a>
    </header>


    <?php
    require_once "vendor/autoload.php";
    require_once "src/utils.php";

    use MyStore\CarModel;

    $user = new CarModel(make_db());
    $cars = $user->getProperties();

    create_list_of_cars($cars);

    ?>
</body>

</html>