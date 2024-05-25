<?php
session_start();
require '../../config/dbconn.php';

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $check_query = "SELECT * FROM admin WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if ($first_name != '' && $last_name != '' && $username != '' && $email != '' && $password != '') {
            $query = "INSERT INTO admin (first_name, last_name, username, email, password)
                      VALUES ('$first_name', '$last_name', '$username', '$email', '$password')";
            $result = mysqli_query($conn, $query);         
            if ($result) {
                header("Location: ../adlog.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "All fields are required.";
        }
    }
}
