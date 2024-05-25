<?php
session_start();
require '../config/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

$store_id_query = "SELECT store_id FROM stores WHERE user_id = '$user_id'";
$store_id_result = mysqli_query($conn, $store_id_query);

if (mysqli_num_rows($store_id_result) == 0) {
    echo "Error: You need to create a store before uploading a product.";
    exit();
}

$row = mysqli_fetch_assoc($store_id_result);
$store_id = $row['store_id'];

if (isset($_POST['upload'])) {
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if ($_FILES['image']['size'] == 0) {
        echo "Error: Please select an image for the product.";
        exit();
    }

    $imageData = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $imageType = $_FILES['image']['type'];
    if ($imageType != "image/jpeg" && $imageType != "image/png" && $imageType != "image/jpg") {
        echo "Error: Only JPG, JPEG, and PNG images are allowed.";
        exit();
    }

    $query = "INSERT INTO products (store_id, name, description, category, price, image) 
        VALUES ('$store_id', '$name', '$description', '$category', '$price', '$imageData')";

    if (mysqli_query($conn, $query)) {
        // Move the header redirect before any output
        header("Location: ../display/upload_product.php");
        exit();
    } else {
        echo "Error uploading product: " . mysqli_error($conn);
    }
}
?>
