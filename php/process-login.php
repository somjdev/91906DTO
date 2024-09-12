<?php
// Checks if the current users login credentials are valid
    $isInvalid = true;

    $uname = $_POST["uname"];
    $unameError = "";
    $pswd = $_POST["pswd"];
    $pswdError = "";

    $options = [];
    $algo = PASSWORD_ARGON2I;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require "../php/login-database.php";

        $result = $mysqli->execute_query("SELECT * FROM `user_info` WHERE `uname` = ?", [$uname]);
        $user = $result->fetch_assoc();
        
        // if the username is correct and the password matches the hash then the user will be logged in
        if ($user) {
            if (password_verify($pswd, $user["hashed_pswd"])) {
                die("Login Successful");
            }
        }
    }

    // checks if the hash of the users password is valid, currently not in use as it puts a lot of strain on my computer
    function pswdHash($pswd, $algo, $options, $oldHash) {
        // check if the password needs rehashing

        // verify plain text password
        if (password_verify($pswd, $oldHash)) {
            // check if the algorithm or options have changed
            if (password_needs_rehash($oldHash, $algo, $options)) {
                // if yes, update hash
                $newHash = password_hash($pswd, $algo, $options);

                print_r($newHash, " Password rehashed"); // temporary for testing
                return $newHash;
                // update pswd in DB, WIP
            } else {
                print_r($oldHash, " Password hash okay"); // temporary for testing
                return $oldHash;
            }
        }
    }
