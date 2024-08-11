<?php
session_start();
$mysqli = require "../php/login-database.php";

$owner_id = $_SESSION['user_id'];
$item_id = $_GET['id'];

$sql = "DELETE FROM order_data WHERE id = '$item_id' AND owner_id = '$owner_id'";

if ($mysqli->query($sql) === TRUE) {
    header("Location:../html/userpage.php"); // ?deleted=$item_id
  } else {
    echo "Error deleting record: " . $mysqli->error;
  }

  $mysqli->close();

exit();