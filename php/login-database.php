<?php
// Key database file which allows the php to sql connection
$host = "localhost";
$dbname = "dto_db";
$username = "root";
$password = "";


$mysqli = new mysqli(
    hostname: $host,
    username: $username,
    password: $password,
    database: $dbname
);

// Checks if the database connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli;