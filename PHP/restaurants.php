<?php
session_start();

if ($_SESSION['loggedin'] == false) {
    header("Location:./loginPage.php");
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    echo "<script>
    alert('Warenkorb wurde geleert');
    </script>";
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="./../Style/style.css">
    <script src="./../JS/restaurants.js" defer></script>
</head>

<body>
    <div class="title-box">
        <!-- <div onclick="window.open('shoppingCart.php', '_self')" class="shopping-cart">
            <img src="./../Img/cart.png" alt="Warenkorb">
        </div> -->
        <svg height="100" stroke="#ECB159" stroke-width="2" class="text-line" width="100%"><text x="50%"
                dominant-baseline="middle" text-anchor="middle" y="50%" font-size="70px">Restaurants</text></svg>
    </div>

    <!--RESTAURENT DEMO-->

    <?php
    // Assuming you have already connected to your MySQL database
    
    // Query to select restaurants
    $_db_host = "localhost";
    $_db_datenbank = "mealfit";
    $_db_username = "webaccess2";
    $_db_passwort = "access";


    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    $sql = "SELECT * from restaurants order by delivery_time";
    $result = $conn->query($sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            // Extracting data from the row
            $name = $row['name'];
            $rating = $row['rating'];
            $delivery_time = $row['delivery_time'];
            $image_url = $row['img_url'];
            $food_type = $row['food_type'];
            $id = $row['id'];

            // Generating HTML for div box
            echo "<div class='restaurant-box-container'>";
            echo "<div title='Jetzt bestellen!' onclick='openRestaurant($id)' class='restaurant-box'>";
            echo '<div class="restaurant-flex-left">';
            echo "<img class='restaurant-img' height='90%' src='./../Img/$image_url' alt='No Logo found'>";
            echo '</div>';
            echo '<div class="restaurant-flex-middle">';
            echo "<p class='restaurant-title'>$name</p>";
            echo "<div class='flex'>";
            for ($i = 0; $i < 5; $i++) {
                if ($i < $rating) {
                    echo "<p class='restaurant-rating'>★</p>";
                } else {
                    echo "<p class='restaurant-rating'>☆</p>";
                }
            }
            echo "</div>";
            echo "<p class='restaurant-food-type'>$food_type</p>";
            echo '</div>';
            echo "<div class='restaurant-flex-right'>";
            echo "<p class='restaurant-delivery-time'><img src='./../Img/bicycle.png' width= '15%'> $delivery_time min</p>";
            echo "</div>";
            echo '</div>';
            echo "</div>";
        }
    } else {
        // If no restaurants found
        echo "No restaurants found.";
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