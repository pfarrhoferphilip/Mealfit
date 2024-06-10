<?php
session_start();

if ($_SESSION['loggedin'] == false) {
    header("Location:./loginPage.php");
} else if (!isset($_SESSION['last_id']) || !isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location:./restaurants.php");
}

//$_SESSION['cart'] = array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danke für deine Bestellung!</title>
    <link rel="stylesheet" href="../Style/style.css">
    <script src="../JS/confirmPurchase.js" defer></script>
</head>

<body>

    <div class="title-box">
        <svg height="100" stroke="#ECB159" stroke-width="2" class="text-line" width="100%"><text x="50%"
                dominant-baseline="middle" text-anchor="middle" y="50%">Danke für deine Bestellung!</text></svg>
    </div>

    <div class="purchase-box-container invisible" id="invis">
        <div class="purchase-box">
            <?php
            // Query to select restaurants
            $_db_host = "localhost";
            $_db_datenbank = "mealfit";
            $_db_username = "webaccess2";
            $_db_passwort = "access";


            $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

            $id = $_SESSION['last_id'];

            $sql = "SELECT * from restaurants where id = " . $id;
            $result = $conn->query($sql);

            // Check if there are any results
            // Loop through each row of data
            $row = mysqli_fetch_assoc($result);
            // Extracting data from the row
            $name = $row['name'];
            $delivery_time = $row['delivery_time'];
            $address = $_GET['adress'] . " " . $_GET['housenumber'] . ", " . $_GET['zip-code'] . " " . $_GET['city'];

            echo "<p class='purchase-title'>Infos zu deiner Bestellung</p>";
            echo "<p>Restaurant: <span class='purchase-highlight'>$name</span></p>";
            echo "<p>Lieferzeit: <span class='purchase-highlight'>$delivery_time min</span></p>";
            echo "<p>Adresse: <span class='purchase-highlight'>$address</span></p>";
            ?>
        </div>
    </div>

    <div id="loading-box">
        <h1 id="loading-item-1" class="loading-item">.</h1>
        <h1 id="loading-item-2" class="loading-item">.</h1>
        <h1 id="loading-item-3" class="loading-item">.</h1>
    </div>
</body>

</html>