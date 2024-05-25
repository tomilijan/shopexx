<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/homestyle.css">
    <title>ShopEx</title>
</head>

<body>
    <nav>
        <img class="logo" src="LOGO.png" alt="Shopex">
        <div class="links">
            <a href="./Login/sign.php" class="signup">Sign Up</a>
            <a href="./Login/log.php" class="login">Login</a>

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
            <img class="carousel_image" src="banner1.jpg" alt="Image 1">
            <img class="carousel_image" src="./image/banner1.jpg">
            <img class="carousel_image" src="image3.jpg" alt="Image 3">
        </div>
    </div>

    <div class="container">
        <h2>Products</h2>
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
                        echo "<p>Category: " . $row['category'] . "</p>";
                        echo "<p>Price: $" . $row['price'] . "</p>";
                        echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                        echo "<button type='submit' class='add-to-cart-btn' name='add_to_cart'>Add to Cart</button>";
                    echo "</div>";
                }
                } else {
                    echo "<p>No products found</p>";
            }
                mysqli_close($conn);
            ?>
    </div>

    <script>
        const images = document.querySelectorAll('.carousel_image');
        let currentImageIndex = 0;

        function showImage(index) {
            images.forEach((image, i) => {
                if (i === index) {
                    image.classList.add('active');
                } else {
                    image.classList.remove('active');
                }
            });
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            showImage(currentImageIndex);
        }

        setInterval(nextImage, 3000);
    </script>

</body>

</html>