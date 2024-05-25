<?php 
session_start(); 
require '../config/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_user'])) {
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name =  mysqli_real_escape_string($conn, $_POST['last_name']);
        $username =  mysqli_real_escape_string($conn, $_POST['username']);

        $update_query = "UPDATE users SET first_name='$first_name', last_name='$last_name', username='$username' WHERE user_id='$user_id'";
        $update_result = mysqli_query($conn, $update_query);

        if (!$update_result) {
            echo "Error updating user information: " . mysqli_error($conn);
        } else {
            header("Location: ../userpage.php"); 
            exit();
        }
    }

    if (isset($_POST['delete_account'])) {
        $delete_query = "DELETE FROM users WHERE user_id='$user_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if (!$delete_result) {
            echo "Error deleting user account: " . mysqli_error($conn);
        } else {
            session_destroy(); 
            header("Location: ../Home.php"); 
            exit();
        }
    }
}

mysqli_close($conn);
?>
User information updated successfully.
