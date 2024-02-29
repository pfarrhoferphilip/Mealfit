<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin'] == true) {
        header("Location:./restaurants.php");
    }
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
                dominant-baseline="middle" text-anchor="middle" y="50%">Login</text></svg>
    </div>

    <div id="login-box">
        <form action="./login.php">
            <div class="input-container">
                <input placeholder="E-Mail" required type="email" name="e-mail" class="login-input" id="e-mail-input">
            </div>
            <div class="input-container">
                <input placeholder="Passwort" required type="password" name="password" class="login-input" id="password-input">
            </div>
            <div class="button-container">
                <input class="login-button" type="submit" value="Anmelden">
            </div>
        </form>
        <p class="register-text">Noch keine Account? <a class="register-link" href="./registerPage.php">Hier Registrieren</a></p>
    </div>

</body>

</html>