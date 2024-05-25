<?php

require '../functions/add_to_cart.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/display_cart.css">
    <title>Cart</title>
    <script src="../assets/cart.js" defer></script>
</head>

<body>
    <div class="container">
        <nav>
                    <img class="logo" src="../LOGO.png" alt="Shopex">
            <div class="links">

                <a href="../redirect.php">Home</a>

                <?php
                require '../config/dbconn.php';


                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id = $user_id";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<a>" . $row['first_name'] . "</a>";
                    }
                } else {

                    header("Location: ./Login/log.php");
                }

                mysqli_close($conn);
                ?>
            </div>
        </nav>
        <div class="cart-items">
            <?php
            require '../config/dbconn.php';

            $total_price = 0;
            $prices = [];

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='cart-item'>";
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<p>Description: " . $row['description'] . "</p>";
                        echo "<p>Category: " . $row['category'] . "</p>";
                        echo "<p>Price: $" . $row['price'] . "</p>";
                        echo "<div class='quantity'>";
                        echo "<button class='quantity-btn decrease-btn' data-action='decrease' data-product-id='" . $row['product_id'] . "'>-</button>";
                        echo "<input type='number' class='quantity-input' value='$quantity' min='1' data-product-id='" . $row['product_id'] . "'>";
                        echo "<button class='quantity-btn increase-btn' data-action='increase' data-product-id='" . $row['product_id'] . "'>+</button>";
                        echo "</div>";
                        echo "<label><input type='checkbox' class='purchase-checkbox' name='selected_items[]' value='" . $row['product_id'] . "'></label>";
                        echo "<form method='post' action='../functions/remove_from_cart.php'>";
                        echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                        echo "<input type='submit' class='remove-btn' name='remove_from_cart' value='Remove'>";
                        echo "</form>";
                        echo "<p>Total: $<span id='product-total-" . $row['product_id'] . "'>" . number_format($row['price'] * $quantity, 2) . "</span></p>";
                        echo "</div>";

                        $prices[$row['product_id']] = $row['price'];
                    }
                }
            } else {
                echo "<p class='empty-cart'>Your cart is empty</p>";
            }
            ?>
        </div>

        <div id="cart">
            <h2>Cart</h2>
            <ul id="cart-items">

            </ul>
            <p>Total: $<span id="cart-total"><?php echo number_format($total_price, 2); ?></span></p>
            <?php if (!empty($_SESSION['cart'])) : ?>
                <form action="../functions/checkout_products.php" method="post">
                    <button class="checkoutbtn" type="submit" name="checkout">Checkout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <script>
        const prices = <?php echo json_encode($prices); ?>;
    </script>

</body>

</html>