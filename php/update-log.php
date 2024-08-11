<?php
// Updates the log daily using windows task scheduler
$mysqli = require "login-database.php";

$cur_date = date("Y-m-d");

$ordersql = "SELECT `id`, `owner_id`, `title`, `arrival_type`, `arrival_period` FROM `order_data` 
WHERE `arrival_date`='$cur_date'";

$order_results = $mysqli->query($ordersql);
// converts the database query to an array row by row
while ($order_row = $order_results->fetch_assoc()) {
    $user_id = $order_row['owner_id'];
    $order_id = $order_row['id'];
    $order_title = addslashes($order_row['title']);
    $order_type = $order_row['arrival_type'];
    $order_period = $order_row['arrival_period'];

    $logsql = "INSERT INTO `order_log`(
    `id`,
    `owner_id`,
    `title`,
    `arrival_type`,
    `log_date`,
    `arrival_period`
)
VALUES(
    '$order_id',
    '$user_id',
    '$order_title',
    '$order_type',
    '$cur_date',
    '$order_period'
)";

    // if the query is successfi; the result will be echoed to the website, this is an admin page so it doesn't need to be displayed to the user
    if ($mysqli->query($logsql) === TRUE) {
        echo "Success ID:" . $order_id;
    } else {
        echo "Failed ID:" . $order_id;
    }

}
