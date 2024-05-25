<?php
// Start the session at the very beginning of the file
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/productby_id.css">
    <title>Seller Products</title>
</head>

<body>
    <nav>
        <a href="../redirect.php">Home</a>
        <a href="../display/upload_product.php">Upload</a>
    </nav>
    <h2>Seller Products Display</h2>
    <table class="product-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Move the session_start() above all the HTML output

            require '../config/dbconn.php';

            if (!isset($_SESSION['user_id'])) {
                echo "Error: User not logged in.";
                exit();
            }

            $user_id = $_SESSION['user_id'];
            $store_id_query = "SELECT store_id FROM stores WHERE user_id = '$user_id'";
            $store_id_result = mysqli_query($conn, $store_id_query);

            if (mysqli_num_rows($store_id_result) == 0) {
                echo "Error: You need to create a store before uploading a product.";
                exit();
            }

            $row = mysqli_fetch_assoc($store_id_result);
            $store_id = $row['store_id'];

            $query = "SELECT * FROM products WHERE store_id = '$store_id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            } else {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'></td>";
                        echo "<td class='actions'>
                                <a class='edit' href='by_id_Edit.php?id=" . $row['product_id'] . "'>Edit</a>
                                <a class='delete' href='../functions/by_id_delete.php?id=" . $row['product_id'] . "'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>

</html>
