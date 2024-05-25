<?php
include '../../config/dbconn.php';

$search = '';
$whereClause = '';

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $whereClause = "WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
}
$sql = "SELECT * FROM products $whereClause";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display All Products</title>
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
    <h2>Products</h2>
    <table>
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
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'></td>";
                    echo "<td class='actions'>
                            <a href='../edit/edit_product.php?id=" . $row['product_id'] . "'>Edit</a>
                            <a href='../function/delete_product.php?id=" . $row['product_id'] . "'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
mysqli_close($conn);
?>