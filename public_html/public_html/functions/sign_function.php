<?php
session_start();
require '../config/dbconn.php';

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if ($first_name != '' && $last_name != '' && $username != '' && $contact != '' && $password != '') {
            $query = "INSERT INTO users (first_name, last_name, username, contact, password)
                      VALUES ('$first_name', '$last_name', '$username', '$contact', '$password')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header("Location: ../Login/log.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "All fields are required.";
        }
    }
}
