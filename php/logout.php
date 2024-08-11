<?php
// Logs the user out and sends the user back to the home page on success
session_start();

session_destroy();

header("Location: ../index.php");
exit;