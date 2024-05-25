<?php
session_start();
require '../../config/dbconn.php';

$sql = "SELECT * FROM checkout_products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@500..800&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Dosis", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7f8;
        }


        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;

            background-color: #599c86;
            padding: 15px 25px;
            margin: 10px 20px;
            border-radius: 30px;
        }

        nav a {
            color: #f5f7f8;
            text-decoration: none;
            margin-right: 20px;
            font-size: 20px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #1f1f1f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 0;
            background-color: #f5f7f8;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f5f7f8;
        }

        th {
            background-color: #599c86;
            color: #f5f7f8;
        }

        tr:hover {
            background-color: #e7e5e5;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }

        .actions a {
            color: #1f1f1f;
            text-decoration: none;
            margin-right: 10px;
        }

        .actions a:hover {
            color: #1f1f1f;
        }
    </style>
</head>

<body>
    <nav>
        <a href="../main_admin.php">Admin Panel</a>
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