<?php
// Deletes an entry from the database
session_start();
$mysqli = require "../php/login-database.php";

$owner_id = $_SESSION['user_id'];
$item_id = $_GET['id'];

// SQL to delete an entry from the order data table if the item id is valid and the owner id is the same as the current users id
$sql = "DELETE FROM order_data WHERE id = '$item_id' AND owner_id = '$owner_id'";

// if the query is successful delete the item and return the user if not return the user and show an error message
if ($mysqli->query($sql) === TRUE) {
    header("Location:../html/userpage.php"); // ?deleted=$item_id
  } else {
    echo "Error deleting record: " . $mysqli->error;
  }

  // close query
  $mysqli->close();

exit();