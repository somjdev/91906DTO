<?php
session_start();

$mysqli = require "../php/login-database.php";

print_r($_POST);

$sql="
UPDATE
    `order_data`
SET
    `id` = '$_POST[id]',
    `title` = '$_POST[title]',
    `arrival_type` = '$_POST[type]',
    `arrival_date` = '$_POST[arrival]',
    `arrival_period` = '$_POST[period]'
WHERE
    `owner_id` = $_SESSION[user_id]
";

if ($mysqli->execute_query($sql)) {
    header("Location: ../html/userpage.php");
} else {
    echo $mysqli->error;
}