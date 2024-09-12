<!DOCTYPE html>
<html lang="en">

<?php
    // intial page setup
    include "head.html";

	session_start();

	if (isset($_SESSION['userID'])) {
		require_once('../html/header-loggedin.html');
	} else {
		header("Location: loginform.php");
	}

	require "../html/footer.html";
?>

<body>
    <?php
        // includes the php file which handles the table
        require_once("../php/logstable.php");
    ?>

    <div class="pop-up">
        <!-- displays current error, WIP -->

    </div>
</body>

</html>
