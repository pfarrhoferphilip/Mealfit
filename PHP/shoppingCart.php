<?php
session_start();

if ($_SESSION['loggedin'] == false) {
    header("Location:./loginPage.php");
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="./../Style/style.css">
</head>

<body>

    <div class='title-box'>;
        <svg height='100' stroke='#ECB159' stroke-width='2' class='text-line' width='100%'><text x='50%'
                dominant-baseline='middle' text-anchor='middle' y='50%'>Warenkorb</text></svg>;
    </div>;

    <?php

    $_db_host = "localhost";
    $_db_datenbank = "mealfit";
    $_db_username = "webaccess2";
    $_db_passwort = "access";


    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    if (isset($_SESSION['cart'])) {
        $items = $_SESSION['cart'];

        // Loop through each row of data
        foreach ($items as $item) {

            $sql = "SELECT * from food_items where id = " . $item;
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $image_url = $row['image_url'];

            echo "<div class='food-item-box-container'>";
            echo "<div class='food-item-box'>";
            echo '<div class="food-item-flex-left">';
            echo "<img class='food-item-img' height='90%' src='./../Img/$image_url' alt='No Picture found'>";
            echo '</div>';
            echo '<div class="food-item-flex-middle">';
            echo "<p class='food-item-title'>$name</p>";
            echo "<p class='food-item-description'>$description</p>";
            echo '</div>';
            echo "<div class='food-item-flex-right'>";
            echo "<p class='food-item-price'>$price €</p>";
            echo "</div>";
            echo '</div>';
            echo "</div>";
        }
    } else {
        echo "<p class='food-item-title'>Warenkorb ist leer</p>";
    }

    ?>

</body>

</html>