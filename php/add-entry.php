<?php
session_start();
$mysqli = require "../php/login-database.php";

// defines all variables for ease of use
$owner_id = $_SESSION["user_id"];
$title = $_POST["title"];
$arrival_type = $_POST["type"];
$arrival_date = $_POST["arrival"];
$arrival_period = $_POST["period"];

// Prepared SQL statement
$sql = "INSERT INTO `order_data` (`id`, `owner_id`, `title`, `arrival_type`, `arrival_date`, `arrival_period`) 
VALUES (NULL, '$owner_id', '$title', '$arrival_type', '$arrival_date', '$arrival_period')";

// executes SQL query if it is sucessful return user back if not display error message
if ($mysqli->query($sql) === TRUE) {
    header("Location: ../html/userpage.php");
}
