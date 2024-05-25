<?php
require '../../config/dbconn.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($username != '' && $password != '') {
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);

                if ($password === $user['password']) {
                    session_start();
                    $_SESSION['admin_id'] = $user['admin_id'];

                    $admin_query = "SELECT * FROM admin WHERE admin_id = " . $_SESSION['admin_id'];
                    $admin_result = mysqli_query($conn, $admin_query);

                    if ($admin_result) {
                        if (mysqli_num_rows($admin_result) > 0) {
                            echo "You are already an admin.";
                            header("Location: ../main_admin.php");
                        } else {
                            echo "Login successful!";
                            header("Location: ../main_admin.php");
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    exit();
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
