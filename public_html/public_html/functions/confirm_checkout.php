<?php

    require '../config/dbconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $total_price = 0;

            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $sql = "SELECT * FROM products WHERE product_id='$productId'";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $total_price += $row['price'] * $quantity;
                    $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES ('$userId', '$productId', '$quantity', '$total_price')";
                    mysqli_query($conn, $sql);
                }
            }

            unset($_SESSION['cart']);

            header("Location: ../display/display_cart.php");
            exit();
        } else {
            header("Location: ../Login/log.php");
            exit();
        }
    }
    mysqli_close($conn);
    ?>