<?php
require '../config/dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST ['product_id']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = $quantity;
            echo "Quantity updated successfully";
        }
    }
}
?>
