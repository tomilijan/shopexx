<?php
require '../config/dbconn.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        if (isset($_POST['submit'])) {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_data = file_get_contents($_FILES['image']['tmp_name']);
                $image = mysqli_real_escape_string($conn, $image_data);

                $update_sql = "UPDATE products SET name='$name', description='$description', category='$category', price='$price', image='$image' WHERE product_id='$product_id'";
            } else {

                $update_sql = "UPDATE products SET name='$name', description='$description', category='$category',price='$price' WHERE product_id='$product_id'";
            }

            $update_result = mysqli_query($conn, $update_sql);

            if ($update_result) {
                header("Location:../display/productby_id.php");
                exit();
            } else {
                echo "Error updating product: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}
