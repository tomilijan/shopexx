<?php

$db_server = "localhost";
$db_username = "id22213129_shopex";
$db_password = "Group1project.";
$db_database = "id22213129_shopex";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
