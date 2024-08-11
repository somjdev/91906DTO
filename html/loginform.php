<!DOCTYPE html>
<html>
<html lang="en">

<?php
    include "head.html";

	session_start();

	if (isset($_SESSION['user_id'])) {
		require_once('../html/header-loggedin.html');
	} else {
		require_once('../html/header.html');
	}

	require "../html/footer.html";

    $isvalid = true;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require "../php/login-database.php";

        $result = $mysqli->execute_query("SELECT * FROM `user_info` WHERE `uname` = ?", [$_POST['uname']]);
        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($_POST['pswd'], $user["hashed_pswd"])) {
                
                session_start();
                
                $_SESSION["user_id"] = $user["id"];

                header("Location: ../index.php");
                exit;
            }
        }
        
        $isvalid = false;
    }
?>

<body>
    <div>
        <div class="loginBackground">
            <div class="loginTop">
                <h2>Login</h2>
            </div>
            <div class="loginContent">
                <?php if (!$isvalid): ?>
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
