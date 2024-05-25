<?php
require '../config/dbconn.php';

session_start();


if(isset($_POST['remove_from_cart'])) {
   
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    if(isset($_SESSION['cart'][$product_id])) {
   
        unset($_SESSION['cart'][$product_id]);
    }

    header("Location: ../display/display_cart.php");
    exit;
}
?>
