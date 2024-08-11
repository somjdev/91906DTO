<?php
session_start();

$mysqli = require "../php/login-database.php";

// SQL which updates the stored data based on given information
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

// execute query if successful return user if not send user back with information for the popup
if ($mysqli->execute_query($sql)) {
    header("Location: ../html/userpage.php");
} else {
    echo $mysqli->error;
}