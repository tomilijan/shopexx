<?php
require '../config/dbconn.php';

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_sql = "DELETE FROM products WHERE product_id='$product_id'";
    $delete_result = mysqli_query($conn, $delete_sql);

    if($delete_result) {
    header("Location: ../display/productby_id.php");
        exit();   
        
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
        
    }
} else {
    echo "Product ID not provided.";
}

mysqli_close($conn);
?>
