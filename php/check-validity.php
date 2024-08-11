<?php
session_start();
$mysqli = require "../php/login-database.php";

$user_id = $_SESSION['user_id'];
$item_id = $_GET['id'];

$sql = "SELECT
    `title`,
    `arrival_type`,
    `arrival_date`,
    `arrival_period`
FROM
    `order_data`
WHERE
    `id` = '$_GET[id]' AND `owner_id` = $user_id";

$result = $mysqli->execute_query($sql);
$data = $result->fetch_assoc();

if ($result) {
    header("Location:../html/userpage.php?edit&id=$item_id&title=$data[title]&type=$data[arrival_type]&date=$data[arrival_date]&period=$data[arrival_period]");
} else {
    header("Location: ../html/userpage.php");
}