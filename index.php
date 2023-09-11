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
        <a href="#">Add book</a>
    </header>


    <?php
    $db = new PDO('mysql:host=db; dbname=car-collection', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT `name`, `year-made`, `zero-sixty`, `price`, `brand` FROM `cars`;");
    $query->execute();
    $cars = $query->fetchAll();

    foreach ($cars as $car) {
        echo "<h3>" . $car["name"] . "</h3>";
        echo "<ul>";
        echo "<li>" . $car["year-made"] . "</li>";
        echo "<li>" . $car["zero-sixty"] . "</li>";
        echo "<li>" . $car["price"] . "</li>";
        echo "<li>" . $car["brand"] . "</li>";
        echo "</ul>";
    }

    ?>
</body>

</html>