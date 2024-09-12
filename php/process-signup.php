<?php
// Proccesses the users signup to the site, WIP variables for storing an error code have been added, in the future these will be used to display the error to the user in the panel rather than redirecting them to a page
$uname = $_POST["uname"];
$unameError = "";
$email = $_POST["email"];
$emailError = "";
$pswd = $_POST["pswd"];
$confpswd = $_POST["confpswd"];
$pswdError = "";

// hashing algorithm settings
$options = [];
$algo = PASSWORD_ARGON2I;

usernameChecks($uname);
passwordChecks($pswd, $confpswd);
$pswdHash = password_hash($pswd, $algo, $options);

$mysqli = require __DIR__ . "/login-database.php";

// Duplicate checks
$dupeUname = $mysqli->execute_query("SELECT id FROM user_info WHERE uname = ? LIMIT 1", [$uname]);
$dupeEmail = $mysqli->execute_query("SELECT id FROM user_info WHERE email = ? LIMIT 1", [$email]);

// If Username/Email appears more than once return an error
if ($dupeUname->num_rows == 1) {
    die("Username already exists");
}
if ($dupeEmail->num_rows == 1) {
    die("Email already exists");
}

// Prepared statement variable initialising connection
$stmt = $mysqli->stmt_init();

// Execution statement/SQL error check
if (!$stmt->prepare("INSERT INTO user_info (uname, email, hashed_pswd) VALUES (?, ?, ?)")) {
    die("". $mysqli->error);
}

$stmt->bind_param("sss", 
    $_POST["uname"],
    $_POST["email"],
    $pswdHash);

try {
    if ($stmt->execute()) {
        header("Location: /html/userpage.php");
        exit;
    }
}
catch (mysqli_sql_exception $e) {
    die("Error: " . $e->getMessage() . " " . $e->getCode());
}

function usernameChecks($username)
{
    // Checks the length of the username is within expected boundaries
    if (strlen($username) < 6) {
        die("Username too short");
    }

    if (strlen($username) > 30) {
        die("Username is too long");
    }

    // Checks if the username contains any illegal special characters
    if (preg_match("/[^a-z_\-0-9]/i", $username)) {
        die("Invalid character/s");
    }

    // Checks if first character is a letter as per username conventions
    if (!ctype_alpha($username[0])) {
        die("Username must start with a letter");
    }

    return;
}

function passwordChecks($pswd, $confpswd)
{
    // Check if repeated password matches
    if ($pswd !== $confpswd) {
        die("Passwords do not match");
    }

    // Check password length
    if (strlen($pswd) < 8) {
        die("Password too short");
    }

    if (strlen($pswd) > 30) {
        die("Password too long");
    }

    // Check if the Password contains a special character, a lower case letter, an upper case letter and a number.
    if (ctype_alnum($pswd)) {
        die("Password must contain at least one special character");
    }

    if (!preg_match("/[a-z]/", $pswd)) {
        die("Password must contain at least one lower case letter");
    }

    if (!preg_match("/[A-Z]/", $pswd)) {
        die("Password must contain at least one upper case letter");
    }

    if (!preg_match("/[0-9]/", $pswd)) {
        die("Password must contain at least one number");
    }


    return;
}

function validEmail($email)
{
    // checks if the format of the email is correct (xxx@xxx.xxx)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email is not valid");
    }
}
