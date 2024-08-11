<?php
session_start();

$mysqli = require "../php/login-database.php";

$item = $_GET['id'];
$cur_status = $_GET['type'];
$owner_id = $_SESSION['user_id'];

if ($cur_status) {
    $sql = "UPDATE `order_log` SET `arrived`='0' WHERE `id`='$item' AND `owner_id` = '$owner_id'";
} else {
    $sql = "UPDATE `order_log` SET `arrived`='1' WHERE `id`='$item' AND `owner_id` = '$owner_id'";
}

if ($mysqli->query($sql) === TRUE) {
    header("Location:../html/logpage.php");
  } else {
    echo "Error processing request: " . $mysqli->error;
  }