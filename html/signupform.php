<!DOCTYPE html>
<html>
<html lang="en">

<?php
// intial page setup
include "head.html";

session_start();

// checks if the user is logged in and if they are display logged in header
if (isset($_SESSION['userID'])) {
    require_once ('../html/header-loggedin.html');
} else {
    require_once ('../html/header.html');
}

require "../html/footer.html";
?>

<body>
    <div>
        <div class="loginBackground">
            <div class="loginTop">
                <h2>Sign Up</h2>
            </div>
            <!-- Sign Up form it uses Login headers to conserve same CSS, in the future I will swap the names to something more generic-->
            <div class="loginContent">
                <form id="loginForm" method="post" action="/php/process-signup.php" novalidate>
                    <label class="loginText"></label>
                    <input type="text" placeholder="Username" name="uname" required>

                    <label class="loginText"></label>
                    <input type="email" placeholder="Email" name="email" required>

                    <label class="loginText"></label>
                    <input type="password" placeholder="Password" name="pswd" required>

                    <label class="loginText"></label>
                    <input type="password" placeholder="Repeat Password" name="confpswd" required>

                    <!--
                    <div class="loginExtras">
                        <input type="checkbox" id="rememberMe"><label for="rememberMe">Remember Me</label>
                        <a href="/loginpage.html" style="float:right">Forgot Password</a>
                    </div>
                    <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>-->
                    <div class="formButtonHolder">
                        <button class="loginSubmit" type="submit" name="submit">Sign Up</button>
                    </div>
                </form>
                <div class="divider">OR</div>
                <div class="formButtonHolder">
                    <a class="signUpButton" href="loginform.php">Login</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
