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
    <title>Warenkorb - Mealtfit</title>
    <link rel="stylesheet" href="./../Style/style.css">
    <script src="../JS/cart.js" defer></script>
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

    //echo $_SESSION['current_restaurant'];
    
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $items = $_SESSION['cart'];

        echo '<div class="button-container">';
        echo '<button class="login-button" onclick="goBack()">Zurück</button>';
        echo '<button class="login-button" onclick="openCheckout()">Zur Kasse</button>';
        echo '</div>';

        // Loop through each row of data
        $count = 0;
        $all_price = 0;
        foreach ($items as $item) {


            $sql = "SELECT * from food_items where id = " . $item;
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $price_display = number_format($price, 2, ',');
            $image_url = $row['image_url'];

            echo "<div class='food-item-box-container'>";
            echo "<div onclick='removeFromCart($count)' class='food-item-box'>";
            echo '<div class="food-item-flex-left">';
            echo "<img class='food-item-img' height='90%' src='./../Img/$image_url' alt='No Picture found'>";
            echo '</div>';
            echo '<div class="food-item-flex-middle">';
            echo "<p class='food-item-title'>$name</p>";
            echo "<p class='food-item-description'>$description</p>";
            echo '</div>';
            echo "<div class='food-item-flex-right'>";
            echo "<p class='food-item-price'>$price_display €</p>";
            echo "</div>";
            echo '</div>';
            echo "</div>";
            $count++;
            $all_price += $price;
        }
        $all_price_display = number_format($all_price, 2, ',');
        echo "<h2 class='food-item-price text-center'>Gesamtpreis: $all_price_display €</h2>";
    } else {
        echo "<p class='cart-noti'>Dein Warenkorb ist derzeit leer</p>";
    }

    ?>

</body>

</html>