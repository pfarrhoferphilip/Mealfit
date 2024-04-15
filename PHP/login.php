<?php
session_start();

$_db_host = "localhost";
$_db_datenbank = "mealfit";
$_db_username = "webaccess2";
$_db_passwort = "access";


$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

$sql = "SELECT * from user";
$result = $conn->query($sql);

$email = $_GET['e-mail'];
$password = md5($_GET['password']);
$login_is_valid = false;

while ($row = $result->fetch_assoc()) {
    //echo $row['mail'] . " " . $row['password'] . " " . $password . "<br>";
    if ($row['mail'] == $email) {
        if ($row['password'] == $password) {
            $login_is_valid = true;
        }
    }
}

if ($login_is_valid == true) {
    $_SESSION['loggedin'] = true;
    header("Location:./restaurants.php");
} else {
    $_SESSION['loggedin'] = false;
    header("Location:./loginPage.php");
}

?>