<!DOCTYPE html>
<html>
<html lang="en">

<?php
    // intial setup
    session_start();
    include "head.html";

    // If the user is logged in display the lpgged in header if not display normal header
	if (isset($_SESSION['userID'])) {
		require_once('../html/header-loggedin.html');
	} else {
		require_once('../html/header.html');
	}

	require "../html/footer.html";

    $isValid = true;

    // checks if the server is using the request method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require "../php/login-database.php";

        // executes SQL query and converts it to an array
        $result = $mysqli->execute_query("SELECT * FROM `user_info` WHERE `uname` = ?", [$_POST['uname']]);
        $user = $result->fetch_assoc();

        //checks if the used data is real by verifying it against the hashed password
        if ($user) {
            if (password_verify($_POST['pswd'], $user["hashed_pswd"])) {
                
                session_start();
                
                $_SESSION["userID"] = $user["id"];

                header("Location: ../index.php");
                exit;
            }
        }
        // if the login is invalid retry and send the user an "invalid credentials" error
        $isValid = false;
    }
?>

<body>
    <div>
        <div class="loginBackground">
            <div class="loginTop">
                <h2>Login</h2>
            </div>
            <div class="loginContent">
                <?php if (!$isValid): ?>
                    <em>Invalid Credentials</em>
                <?php endif; ?>
                <form id= "loginForm" method="post">
                    <label class="loginText"></label>
                    <input type="text" placeholder="Username" name="uname" required>
                    <label class="loginText"></label>
                    <input type="password" placeholder="Password" name="pswd" required>
                    <!--
                    <div class="loginExtras">
                        <input type="checkbox" id="rememberMe"><label for="rememberMe">Remember Me</label>
                        <a href="/loginpage.html" style="float:right">Forgot Password</a>
                    </div>
                    <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>-->
                    <div class="formButtonHolder">
                        <button class="loginSubmit" type="submit" name="submit">Login</button>
                    </div>
                </form>
                <div class="divider">OR</div>
                <div class="formButtonHolder">
                    <a class="signUpButton" href="signupform.php">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
