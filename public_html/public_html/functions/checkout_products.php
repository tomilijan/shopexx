<?php
session_start();
require '../config/dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (!empty($_SESSION['cart'])) {
        $sql = "INSERT INTO checkout_products (product_id, user_id, quantity, price, total_price, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        foreach ($_SESSION['cart'] as $product_id => $quantity) {

            $product_query = "SELECT * FROM products WHERE product_id = ?";
            $product_stmt = $conn->prepare($product_query);
            $product_stmt->bind_param("i", $product_id);
            $product_stmt->execute();
            $product_result = $product_stmt->get_result();

            if ($product_result->num_rows > 0) {
                $product_row = $product_result->fetch_assoc();

                $price = $product_row['price'];
                $total_price = $price * $quantity;

                // Removed the line that echoes product details

                $stmt->bind_param("iiidds", $product_id, $user_id, $quantity, $price, $total_price, $product_row['image']);
                $stmt->execute();
            }
        }
        // Move header redirect before any output
        header("Location: ../display/payment_form.php");
        exit(); // Always call exit after header redirect
    } else {
        // Move header redirect before any output
        header("Location: ../display/cart.php");
        exit(); // Always call exit after header redirect
    }
} else {
    // Move header redirect before any output
    header("Location: ../user/login.php");
    exit(); // Always call exit after header redirect
}
?>
