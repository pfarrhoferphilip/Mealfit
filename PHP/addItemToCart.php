<?php
session_start();

if (isset($_SESSION['cart'])) {
    array_push($_SESSION['cart'], $_GET['id']);
} else {
    $_SESSION['cart'] = array();
    array_push($_SESSION['cart'], $_GET['id']);
}

echo json_encode($_SESSION['cart']);

?>