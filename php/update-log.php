<?php
// Updates the log daily using windows task scheduler
$mysqli = require "login-database.php";

$curDate = date("Y-m-d");

$ordersql = "SELECT `id`, `owner_id`, `title`, `arrival_type`, `arrival_period` FROM `order_data` 
WHERE `arrival_date`='$curDate'";

$order_results = $mysqli->query($ordersql);
// converts the database query to an array row by row
while ($orderRow = $order_results->fetch_assoc()) {
    $userID = $orderRow['owner_id'];
    $orderID = $orderRow['id'];
    $orderTitle = addslashes($orderRow['title']);
    $orderType = $orderRow['arrival_type'];
    $orderPeriod = $orderRow['arrival_period'];

    $logsql = "INSERT INTO `order_log`(
    `id`,
    `owner_id`,
    `title`,
    `arrival_type`,
    `log_date`,
    `arrival_period`
)
VALUES(
    '$orderID',
    '$userID',
    '$orderTitle',
    '$orderType',
    '$curDate',
    '$orderPeriod'
)";

    // if the query is successfi; the result will be echoed to the website, this is an admin page so it doesn't need to be displayed to the user
    if ($mysqli->query($logsql) === TRUE) {
        echo "Success ID:" . $orderID;
    } else {
        echo "Failed ID:" . $orderID;
    }

}
