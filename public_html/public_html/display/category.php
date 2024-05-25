<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="../assets/user.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }

        .product {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .product-details {
            padding: 10px 0;
        }

        .product-name {
            margin: 0;
            font-size: 18px;
        }

        .product-description {
            color: #666;
        }

        .product-price {
            font-weight: bold;
        }

        .add-to-cart-form {
            margin-top: 10px;
        }

        .add-to-cart-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }

        .no-products,
        .no-category {
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>
    <?php
    require '../config/dbconn.php';

    if (isset($_GET['category'])) {
        $selected_category = $_GET['category'];

        $sql = "SELECT * FROM products WHERE category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $selected_category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='container'>";
            echo "<h2>Products in Category: $selected_category</h2>";
            echo "<div class='product-list'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img class='product-image' src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'>";
                echo "<div class='product-details'>";
                echo "<h3 class='product-name'>" . $row['name'] . "</h3>";
                echo "<p class='product-description'>" . $row['description'] . "</p>";
                echo "<p class='product-price'>Price: $" . $row['price'] . "</p>";
                echo "<form class='add-to-cart-form' method='post' action='../functions/add_to_cart.php'>";
                echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                echo "<button type='submit' class='add-to-cart-btn' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p class='no-products'>No products found in the selected category.</p>";
        }
    } else {
        echo "<p class='no-category'>No category selected.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>

</html>