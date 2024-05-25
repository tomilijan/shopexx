<?php
session_start();
require '../config/dbconn.php';

$sql = "SELECT * FROM checkout_products WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$user_id = $_SESSION['user_id'];
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/outprod.css">
    <title>Display Products</title>

</head>

<body>
    <nav>
        <a href="../userpage.php">Home</a>
    </nav>
    <h2>Checkout Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>User ID</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>Product ID: " . $row['product_id'] . "</td>";
                    echo "<td>User ID: " . $row['user_id'] . "</td>";
                    echo "<td>Quantity: " . $row['quantity'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'></td>";
                    echo "<td>Price: $" . $row['price'] . "</td>";
                    echo "<td>Total Price: $" . $row['total_price'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No checkout products found.</td></tr>";
            }

            ?>
        </tbody>
    </table>
</body>

</html>

<?php
mysqli_close($conn);
?>