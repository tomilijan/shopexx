<?php
require '../config/dbconn.php';

// Start the session
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($username != '' && $password != '') {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);

                if ($password === $user['password']) {
                    // Set session user_id
                    $_SESSION['user_id'] = $user['user_id'];

                    $user_id = $user['user_id'];
                    $store_query = "SELECT * FROM stores WHERE user_id = '$user_id'";
                    $store_result = mysqli_query($conn, $store_query);

                    if ($store_result) {
                        if (mysqli_num_rows($store_result) > 0) {
                            // Redirect to redirect.php if store exists
                            header("Location: ../redirect.php");
                            exit(); // Always call exit after header redirect
                        } else {
                            // Redirect to userpage.php if store does not exist
                            header("Location: ../userpage.php");
                            exit(); // Always call exit after header redirect
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "User not found.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Username and password are required.";
    }
}
?>
