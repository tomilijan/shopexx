<?php
require '../config/dbconn.php';

if (isset($_POST['increase_quantity'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    }
    header("Location: ../userpage.php");
    exit;
}

if (isset($_POST['decrease_quantity'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
        $_SESSION['cart'][$product_id]--;
    }
    header("Location: ../userpage.php");
    exit;
}
?>