<?php
session_start();
$mysqli = require "../php/login-database.php";

// defines all variables for ease of use
$ownerID = $_SESSION["user_id"];
$title = $_POST["title"];
$arrivalType = $_POST["type"];
$arrivalDate = $_POST["arrival"];
$arrivalPeriod = $_POST["period"];

// Prepared SQL statement
$sql = "INSERT INTO `order_data` (`id`, `owner_id`, `title`, `arrival_type`, `arrival_date`, `arrival_period`) 
VALUES (NULL, '$ownerID', '$title', '$arrivalType', '$arrivalDate', '$arrivalPeriod')";

// executes SQL query if it is sucessful return user back if not display error message
if ($mysqli->query($sql) === TRUE) {
    header("Location: ../html/userpage.php");
}
