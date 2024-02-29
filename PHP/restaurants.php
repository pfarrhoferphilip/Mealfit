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
    <title>Login</title>
    <link rel="stylesheet" href="./../Style/style.css">
</head>

<body>
    <div class="title-box">
        <svg height="100" stroke="#ECB159" stroke-width="2" class="text-line" width="100%"><text x="50%"
                dominant-baseline="middle" text-anchor="middle" y="50%">Restaurants</text></svg>
    </div>

</body>

</html>