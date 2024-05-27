<?php
session_start();

if (isset($_SESSION['cart'])) {
    array_splice($_SESSION['cart'], $id, 1);
}

echo json_encode($_SESSION['cart']);

?>