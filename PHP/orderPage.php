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
    <title>Bestellen</title>
    <link rel="stylesheet" href="./../Style/style.css">
    <script src="./../JS/order.js" defer></script>
</head>

<body>
    <!--RESTAURENT DEMO-->

    <?php
    // Assuming you have already connected to your MySQL database
    
    // Query to select restaurants
    $_db_host = "localhost";
    $_db_datenbank = "mealfit";
    $_db_username = "webaccess2";
    $_db_passwort = "access";


    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    $sql = "SELECT * from restaurants where id = " . $_GET['id'];
    $result = $conn->query($sql);

    // Check if there are any results
    // Loop through each row of data
    $row = mysqli_fetch_assoc($result);
    // Extracting data from the row
    $name = $row['name'];

    // Generating HTML for div box
    
    echo "<div class='title-box'>";
    echo "<div onclick='openShoppingCart()' class='shopping-cart'>";
    echo '<img src="./../Img/cart.png" alt="Warenkorb">';
    echo "</div>";
    echo "<svg height='100' stroke='#ECB159' stroke-width='2' class='text-line' width='100%'><text x='50%' dominant-baseline='middle' text-anchor='middle' y='50%'>$name</text></svg>";
    echo '</div>';

    $sql = "SELECT * from food_items where restaurant_id = " . $_GET['id'];
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of data
        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $image_url = $row['image_url'];

            echo "<div onclick='addToCart($id)' class='food-item-box-container'>";
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
    }

    ?>

    <!--
        <div class="restaurant-box">
        <div class="restaurant-flex-left">
            <img class="restaurant-img" height="100%" src="./../Img/testLogo.png" alt="Test Restaurant Lego">
        </div>
        <div class="restaurant-flex-right">
            <p class="restaurant-title"></p>
        </div>
    </div>
    -->

</body>

</html>