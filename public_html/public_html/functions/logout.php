<?php
require '../config/dbconn.php';

session_start();


$_SESSION = array();

session_destroy();


header("Location: ../Home.php");
exit();
?>
