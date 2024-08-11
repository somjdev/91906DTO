<?php
    $is_invalid = true;

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

        if ($user) {
            if (password_verify($pswd, $user["hashed_pswd"])) {
                die("Login Successful");
            }
        }
    }

    
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