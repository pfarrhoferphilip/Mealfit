<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./../Style/style.css">
</head>

<body>
    <div class="title-box">
        <svg height="100" stroke="#ECB159" stroke-width="2" class="text-line" width="100%"><text x="50%"
                dominant-baseline="middle" text-anchor="middle" y="50%" font-size="70px">Registrieren</text></svg>
    </div>

    <div id="login-box">
        <form action="./register.php">
            <div class="input-container">
                <input placeholder="E-Mail" required type="email" name="e-mail" class="login-input" id="e-mail-input">
            </div>
            <div class="input-container">
                <input placeholder="Passwort" required type="password" name="password" class="login-input"
                    id="password-input">
            </div>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "passwordshort") {
                    echo "<p class='error-message'>Passwort muss mind. 8 Zeichen lang sein</p>";
                }
            }
            ?>
            <div class="input-container">
                <input placeholder="Passwort wiederholen" required type="password" name="password-again"
                    class="login-input" id="password-input-again">
            </div>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "passwordmatch") {
                    echo "<p class='error-message'>Passwörter stimmen nicht überein</p>";
                } else if ($_GET['error'] == "sql") {
                    echo "<p class='error-message'>Internal Server Error</p>";
                } else {
                    echo "<p class='error-message'>Unknown error. Please try again.</p>";
                }
            }
            ?>
            <div class="button-container">
                <input class="login-button" type="submit" value="Registrieren">
            </div>
        </form>
        <p class="register-text">Du hast bereits einen Account? <br><a class="register-link" href="./loginPage.php">Hier
                Anmelden</a></p>
    </div>

</body>

</html>