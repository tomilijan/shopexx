<?php
session_start();
require './config/dbconn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['first_name'];
    } else {
        $user_name = "Unknown";
    }
} else {
    // Redirect to login page or display error message
    $user_name = "Unknown";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/user.css">
    <title>ShopEx</title>
</head>

<body>
    <nav>
        <h1 class="logo">ShopEX</h1>
        <div class="links">

            <div class="dropdown">
                <a class="dropbtn">Categories</a>
                <div class="dropdown_content">
                    <?php
                    require './config/dbconn.php';

                    $sql = "SELECT DISTINCT category FROM products";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<a href='./display/category.php?category=" . urlencode($row['category']) . "'>" . $row['category'] . "</a>";
                        }
                    } else {
                        echo "<a href='#'>No categories found</a>";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>

            <a class="cart" href="./display/display_cart.php">Cart</a>

            <div class="dropdown">
                <a href="#" class="dropbtn">
                    <?php echo $user_name; ?>
                </a>
                <div class="dropdown_content">
                    <a href="./display/profile.php">Profile</a>
                    <a href="./display/outprod.php">Ordered Product</a>
                    <a href="./display/upload_product.php">Upload Product</a>
                    <a href="./display/productby_id.php">Seller Product</a>
                    <a href="./functions/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="promotion">
        <div class="intro">
            <h1>NEW!!!</h1>
            <h2>DISCOVERIES</h2>
            <h2>at ShopEx</h2>
            <p>"Your Trusted Partner in Shopping Adventures"</p>
        </div>
        <div class="carousel">

        </div>
    </div>

    <div class="container">
        <h2>Buy Products</h2>
        <div class="product_box">
            <?php
            require './config/dbconn.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Description: " . $row['description'] . "</p>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<div class='btn'>";
                    echo "<form method='post' action='./functions/add_to_cart.php'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                    echo "<button type='submit' class='add-to-cart-btn' name='add_to_cart'>Add to Cart</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products found</p>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>
