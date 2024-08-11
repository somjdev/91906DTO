<?php
// Changes the status of logged items between true and false
session_start();

$mysqli = require "../php/login-database.php";

$item = $_GET['id'];
$cur_status = $_GET['type'];
$owner_id = $_SESSION['user_id'];

// if true change to false if false change to true
if ($cur_status) {
    $sql = "UPDATE `order_log` SET `arrived`='0' WHERE `id`='$item' AND `owner_id` = '$owner_id'";
} else {
    $sql = "UPDATE `order_log` SET `arrived`='1' WHERE `id`='$item' AND `owner_id` = '$owner_id'";
}

// Return upon success
if ($mysqli->query($sql) === TRUE) {
    header("Location:../html/logpage.php");
  } else {
    echo "Error processing request: " . $mysqli->error;
  }