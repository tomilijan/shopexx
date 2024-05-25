

<?php
require '../../config/dbconn.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (isset($_POST['submit'])) {
    
            $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);

            $update_sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', username='$username', contact='$contact' WHERE user_id='$user_id'";
          
            $update_result = mysqli_query($conn, $update_sql);

            if ($update_result) {
                header("Location: ../admin_display/display_user.php");
                exit();
            } else {
                echo "Error updating user: " . mysqli_error($conn);
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not provided.";
}
?>
