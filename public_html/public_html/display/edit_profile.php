<?php
session_start();
require '../config/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching user information: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../assets/edit_profile.css">
            <title>Edit Profile</title>

        </head>

        <body>
            <form method="post" action="../functions/profile_function.php">
                <h2>Edit User Information</h2>

                <div>
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $user_info['first_name']; ?>" required>
                </div>
                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $user_info['last_name']; ?>" required>
                </div>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user_info['username']; ?>" required>
                </div>
                <div>
                    <button type="submit" name="edit_user">Update</button>
                </div>

            </form>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </body>

        </html>
<?php
    } else {
        echo "Error: User not found.";
    }
}

mysqli_close($conn);
?>