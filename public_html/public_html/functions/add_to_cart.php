<?php
session_start();
require '../config/dbconn.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    if (isset($_SESSION['cart'])) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    header("Location: ../redirect.php"); 
    exit;
}
