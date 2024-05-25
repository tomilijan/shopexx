<?php
session_start();
require '../config/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

$check_query = "SELECT * FROM stores WHERE user_id = '$user_id'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {

    header("Location: ../redirect.php");
    exit();
}

if (isset($_POST['add_store'])) {

    $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
    $store_description = mysqli_real_escape_string($conn, $_POST['store_description']);

    $name_check_query = "SELECT * FROM stores WHERE store_name = '$store_name'";
    $name_check_result = mysqli_query($conn, $name_check_query);

    if (mysqli_num_rows($name_check_result) > 0) {

        echo "Error: Store name already exists.";
        exit();
    }

    $query = "INSERT INTO stores (store_name, user_id, store_description) 
              VALUES ('$store_name', '$user_id','$store_description')";

    if (mysqli_query($conn, $query)) {

        header("Location: ../display/upload_product.php");
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }
}
