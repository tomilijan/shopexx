<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="#">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@500..800&display=swap');
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Dosis", sans-serif;
        }

        .dosis {
            font-family: "Dosis", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }

        body {
            text-transform: capitalize;
            margin: 0;
            padding: 0;
            background-color: #f5f7f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        nav {
            margin: 0 auto; /* Center the nav */
            background-color: #599c86;
            color: #fff;
            padding: 40px 0; /* Increase padding */
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            width: 80%; /* Set a width */
            border-radius: 10px; /* Optional: Add rounded corners */
        }

        nav a {
            text-decoration: none;
            color: #f5f7f8;

            width: 300px;
            padding: 40px;
        }

        nav a:hover {
            background-color: #f5f7f8;
            color: #1f1f1f;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require '../config/dbconn.php';

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row['first_name'];
        }
    } else {
        header("Location: ");
    }

    mysqli_close($conn);
    ?>

    <nav>
        <div>
            <a href="./admin_display/display_user.php">User Account</a>
        </div>
        <div>
            <a href="./admin_display/display_product.php">All Product</a>
        </div>
        <div>
            <a href="./admin_display/display_order.php">All Order Display</a>
        </div>
        <div>
            <a href="./admin_display/display_check.php">Checkout Display</a>
        </div>
    </nav>
</body>

</html>