<?php
// Checks validity of users credientials before displaying information
session_start();
$mysqli = require "../php/login-database.php";

$userID = $_SESSION['user_id'];
$itemID = $_GET['id'];

// SQL query which returns information if the owner id matches current user id and the supplied id is valid
$sql = "SELECT
    `title`,
    `arrival_type`,
    `arrival_date`,
    `arrival_period`
FROM
    `order_data`
WHERE
    `id` = '$_GET[id]' AND `owner_id` = $userID";

$result = $mysqli->execute_query($sql);
$data = $result->fetch_assoc();

// if the result is valid send get request to userpage containing retrieved information if not return user with no information and prompt an error message
if ($result) {
    // Link contains GET data surrounding item information
    header("Location:../html/userpage.php?edit&id=$itemID&title=$data[title]&type=$data[arrivalType]&date=$data[arrivalDate]&period=$data[arrivalPeriod]");
} else {
    header("Location: ../html/userpage.php");
}
