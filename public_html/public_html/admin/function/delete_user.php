<?php
require '../../config/dbconn.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $delete_sql = "DELETE FROM users WHERE user_id='$user_id'";
        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            header("Location: ../admin_display/display_user.php");
            exit();
        } else {
            echo "Error deleting User: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not provided.";
}

mysqli_close($conn);
