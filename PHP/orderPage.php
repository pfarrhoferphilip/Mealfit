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
    <link rel="shortcut icon" href="../Img/logo.png" type="image/png">
</head>

<body>
    <!--RESTAURENT DEMO-->

    <?php

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        if (isset($_SESSION['last_id']) && !empty($_SESSION['last_id'])) {
            $id = $_SESSION['last_id'];
        } else {
            header("Location:./restaurants.php");
        }
    }

    $_SESSION['last_id'] = $id;

    // Connecting to the database
    // Assuming you have already connected to your MySQL database
    
    // Query to select restaurants
    $_db_host = "localhost";
    $_db_datenbank = "mealfit";
    $_db_username = "webaccess2";
    $_db_passwort = "access";


    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    $sql = "SELECT * from restaurants where id = " . $id;
    $result = $conn->query($sql);

    // Check if there are any results
    // Loop through each row of data
    $row = mysqli_fetch_assoc($result);
    // Extracting data from the row
    $name = $row['name'];

    echo "<div class='title-box'>";
    echo "<div onclick='openShoppingCart()' class='shopping-cart'>";
    echo '<img src="./../Img/cart.png" alt="Warenkorb">';
    echo "</div>";
    echo "<div onclick='back()' class='back-button-order'>";
    echo '<p>Zurück</p>';
    echo "</div>";
    echo "<svg height='100' stroke='#ECB159' stroke-width='2' class='text-line' width='100%'><text x='50%' dominant-baseline='middle' text-anchor='middle' y='50%'>$name</text></svg>";
    echo '</div>';
    echo "<div class='category-box'>";

    $sql = "SELECT category from food_items where restaurant_id = " . $id . " group by category";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            $cat = $row['category'];
            echo "<a href='#$cat' class='category-button'>$cat</a>";
        }
    }

    echo "</div>";

    $selectedFilter = isset($_GET['filter']) ? $_GET['filter'] : 'calories';

    echo "<div style='margin-top: 1%;' class='center-items filter-box'>";
    echo "<form action='./orderPage.php' method='get'>";
    echo "<select onchange='this.form.submit()' name='filter' id='filter'>";

    $options = [
        'calories' => 'Kalorien',
        'protein DESC' => 'Protein',
        'carbs' => 'Kohlenhydrate',
        'fat' => 'Fett',
        'price' => 'Preis'
    ];

    foreach ($options as $value => $label) {
        $selected = ($value == $selectedFilter) ? 'selected' : '';
        echo "<option value='$value' $selected>$label</option>";
    }

    echo "</select>";
    echo "</form>";

    echo "</div>";

    $sql = "";
    if (isset($_GET['filter'])) {
        $sql = "SELECT * from food_items where restaurant_id = " . $id . " order by category, " . $_GET['filter'];
    } else {
        $sql = "SELECT * from food_items where restaurant_id = " . $id . " order by category, calories";
    }

    $result = $conn->query($sql);
    $restaurant_id = $id;

    $last_cat = "";
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of data
        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $price_display = number_format($price, 2, ',');
            $image_url = $row['image_url'];
            $cal = $row["calories"];
            $protein = $row['protein'];
            $fat = $row['fat'];
            $carbs = $row['carbs'];
            $category = $row['category'];

            if ($category != $last_cat) {
                echo "<h2 id='$category' class='category-title'>$category</h2>";
                $last_cat = $category;
            }

            echo "<div class='food-item-box-container'>";
            echo "<div onclick='addToCart($id,$restaurant_id)' class='food-item-box'>";
            echo '<div class="food-item-flex-left">';
            echo "<img class='food-item-img' height='90%' src='./../Img/$image_url' alt='No Picture found'>";
            echo '</div>';
            echo '<div class="food-item-flex-middle">';
            echo "<p class='food-item-title'>$name</p>";
            echo "<p class='food-item-description'>$description</p>";
            echo "<div class='macros-box'>";
            echo "<div class='flex-width'>";
            echo "<p class='macro'><span class='macro-span'>Kalorien:</span> $cal kcal</p>";
            echo "<p class='macro'><span class='macro-span'>Protein:</span> $protein g</p>";
            echo "</div>";
            echo "<div class='flex-width'>";
            echo "<p class='macro'><span class='macro-span'>Fett:</span> $fat g</p>";
            echo "<p class='macro'><span class='macro-span'>Kohlenhydrate:</span> $carbs KE</p>";
            echo "</div>";
            echo "</div>";
            echo '</div>';
            echo "<div class='food-item-flex-right'>";
            echo "<p class='food-item-price'>$price_display €</p>";
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