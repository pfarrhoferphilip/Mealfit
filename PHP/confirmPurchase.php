<?php
session_start();

if ($_SESSION['loggedin'] == false) {
    header("Location:./loginPage.php");
}

$_SESSION['cart'] = array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danke für deine Bestellung!</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>

<body>
    <div id="loading-box">
        <h1 id="loading-item-1">.</h1>
        <h1 id="loading-item-2">.</h1>
        <h1 id="loading-item-3">.</h1>
    </div>
</body>

</html>