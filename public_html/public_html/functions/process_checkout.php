<?php
require_once('../config/dbconn.php');

if (isset($_POST['checkout'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "INSERT INTO checkout_information (name, email, address) 
    VALUES ('$name', '$email', '$address')";

    if (mysqli_query($conn, $query)) {
        // Removed echo statement
        header("Location: ../display/display_cart.php");
        exit();
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

