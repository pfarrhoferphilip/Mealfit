<?php
session_start();

$_db_host = "localhost";
$_db_datenbank = "foodonwings";
$_db_username = "webaccess";
$_db_passwort = "access";


$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

if (strlen($_GET['password']) >= 8) {
    $email = $conn->real_escape_string($_GET['e-mail']);
    $password = $conn->real_escape_string($_GET['password']);

    $innerStatement = "INSERT INTO user (mail, password) 
            VALUES ('$email', md5('$password'));";
    try {
        if ($_res = $conn->query($innerStatement)) {
            echo "Success.";
            header("Location:./loginPage.php");
        }
    } catch (\Throwable $th) {
        echo "Failed.";
        header("Location:./registerPage.php");
    }
} else {
    echo "Failed.";
    header("Location:./registerPage.php");
}

$conn->close();
?>