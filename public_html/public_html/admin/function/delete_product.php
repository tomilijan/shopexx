<?php
require '../../config/dbconn.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        $delete_sql = "DELETE FROM products WHERE product_id='$product_id'";
        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            header("Location: ../admin_display/display_product.php");
            exit();
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}

mysqli_close($conn);
?>