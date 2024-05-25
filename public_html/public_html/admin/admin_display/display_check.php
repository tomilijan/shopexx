<?php
// Include the database connection file
require '../../config/dbconn.php';

// Fetch data from the checkout_information table
$checkout_query = "SELECT * FROM checkout_information";
$checkout_result = mysqli_query($conn, $checkout_query);

$payments_query = "SELECT * FROM payments";
$payments_result = mysqli_query($conn, $payments_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Information and Payment</title>
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
<a href="../main_admin.php">Admin Panel</a>

<body>
    <h2>Checkout Information</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Checkout</th>
        </tr>
        <?php
        if ($checkout_result && mysqli_num_rows($checkout_result) > 0) {
            while ($checkout_row = mysqli_fetch_assoc($checkout_result)) {
                echo "<tr>";
                echo "<td>" . $checkout_row['id'] . "</td>";
                echo "<td>" . $checkout_row['name'] . "</td>";
                echo "<td>" . $checkout_row['email'] . "</td>";
                echo "<td>" . $checkout_row['address'] . "</td>";
                echo "<td>" . $checkout_row['checkout_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No checkout information found.</td></tr>";
        }
        ?>
    </table>

    <h2>Payment</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Result</th>
            <th>Date</th>
        </tr>
        <?php
        if ($payments_result && mysqli_num_rows($payments_result) > 0) {
            while ($payments_row = mysqli_fetch_assoc($payments_result)) {
                echo "<tr>";
                echo "<td>" . $payments_row['id'] . "</td>";
                echo "<td>" . $payments_row['amount'] . "</td>";
                echo "<td>" . (isset($payments_row['result']) ? $payments_row['result'] : 'N/A') . "</td>";
                echo "<td>" . (isset($payments_row['created_at']) ? $payments_row['created_at'] : 'N/A') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No payment information found.</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>