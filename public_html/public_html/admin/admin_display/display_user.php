<?php
include '../../config/dbconn.php';

$search = '';
$whereClause = '';

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $whereClause = "WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
}
$sql = "SELECT * FROM users $whereClause";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@500..800&display=swap');

*{
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
        <div>

        </div>
    </nav>
    <table>
        <h2>Users</h2>
        <thead>
            <tr>
                <th>User Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require '../../config/dbconn.php';

            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td class='actions'>
                            <a href='../edit/edit_user.php?id=" . $row['user_id'] . "'>Edit</a>
                            <a href='../function/delete_user.php?id=" . $row['user_id'] . "'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "No users found";
            }

            mysqli_close($conn);
            ?>

        </tbody>
    </table>
</body>

</html>