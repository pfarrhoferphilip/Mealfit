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
    <title>Checkout - Mealfit</title>
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="shortcut icon" href="./Img/logo.png" type="image/png">
</head>

<body>
    <div class="title-box">
        <svg height="100" stroke="#ECB159" stroke-width="2" class="text-line" width="100%"><text x="50%"
                dominant-baseline="middle" text-anchor="middle" y="50%">Kasse</text></svg>
    </div>

    <div onclick="window.open('enterPhone.php', '_blank')" id="phone-number-popup">
        <h2>Sichere dir 10% Rabatt auf deine Bestellung hier!</h2>
    </div>

    <form action="confirmPurchase.php">
        <div class="flex-width">
            <div id="checkout-div-left">
                <div class="checkout-input-div">
                    <p class="checkout-input-title">*Straße</p>
                    <input required class="checkout-input" type="text" name="adress" id="adress">

                    <p class="checkout-input-title">*Postleitzahl</p>
                    <input required class="checkout-input" type="text" name="zip-code" id="zip-code">

                    <p class="checkout-input-title">*Vorname</p>
                    <input required class="checkout-input" type="text" name="firstname" id="firstname">
                </div>
                <div class="checkout-input-div">
                    <p class="checkout-input-title">*Hausnummer</p>
                    <input required class="checkout-input" type="text" name="housenumber" id="housenumber">

                    <p class="checkout-input-title">*Stadt</p>
                    <input required class="checkout-input" type="text" name="city" id="city">

                    <p class="checkout-input-title">*Nachname</p>
                    <input required class="checkout-input" type="text" name="lastname" id="lastname">
                </div>
            </div>



            <div id="checkout-div-right">
                <h1 class="checkout-cart-title">Warenkorb</h1>
                <hr>
                <?php
                $_db_host = "localhost";
                $_db_datenbank = "mealfit";
                $_db_username = "webaccess2";
                $_db_passwort = "access";

                $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);


                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $items = $_SESSION['cart'];

                    // Loop through each row of data
                    $count = 0;
                    $all_price = 0;
                    foreach ($items as $item) {


                        $sql = "SELECT * from food_items where id = " . $item;
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);

                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $price_display = number_format($price, 2, ',');

                        echo "<p class='checkout-cart-item'>$name - <span style='color: yellow;'>$price_display €</span></p>";
                        $count++;
                        $all_price += $price;
                    }
                    $all_price_display = number_format($all_price, 2, ',');
                    echo "<hr>";
                    echo "<p class='checkout-cart-item'><span style='color: yellow;'>$all_price_display €</span></p>";

                } else {
                    header("Location:./shoppingCart.php");
                }
                ?>
            </div>
        </div>

        <div id="purchase-button-box">
            <button class="login-button">Jetzt Bezahlen</button>
        </div>
    </form>

</body>

</html>