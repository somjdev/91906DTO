<?php
// Changes the status of logged items between true and false
session_start();

$mysqli = require "../php/login-database.php";

$item = $_GET['id'];
$curStatus = $_GET['type'];
$ownerID = $_SESSION['userID'];

// if true change to false if false change to true
if ($curStatus) {
    $sql = "UPDATE `order_log` SET `arrived`='0' WHERE `id`='$item' AND `ownerID` = '$ownerID'";
} else {
    $sql = "UPDATE `order_log` SET `arrived`='1' WHERE `id`='$item' AND `ownerID` = '$ownerID'";
}

// Return upon success
if ($mysqli->query($sql) === TRUE) {
    header("Location:../html/logpage.php");
  } else {
    echo "Error processing request: " . $mysqli->error;
  }
