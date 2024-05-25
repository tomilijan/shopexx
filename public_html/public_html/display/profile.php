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
            <link rel="stylesheet" href="../assets/profile.css">
            <title>Profile</title>

        </head>

        <body>
            <div class="container">
                <div class="profile-card">
                    <h2>User Information</h2>
                    <p><strong>User ID:</strong> <?php echo $user_info['user_id']; ?></p>
                    <p><strong>First Name:</strong> <?php echo $user_info['first_name']; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $user_info['last_name']; ?></p>
                    <p><strong>Username:</strong> <?php echo $user_info['username']; ?></p>

                    <form method="post" action="../functions/profile_function.php">
                        <div class="button-group">
                            <button class="update-button" type="button" onclick="window.location.href='../display/edit_profile.php'">Update User Info</button>
                            <button class="delete-button" type="submit" name="delete_account">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Error: User not found.";
    }
}

mysqli_close($conn);
?>