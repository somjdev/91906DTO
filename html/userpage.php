<!DOCTYPE html>
<html lang="en">

<?php
    include "head.html";

	session_start();

	if (isset($_SESSION['userID'])) {
		require_once('../html/header-loggedin.html');
	} else {
		header("Location: loginform.php");
	}

    // includes the side and all of it's functionality
    require "../php/sidebar.php";

	require "../html/footer.html";
?>

<body>
    <?php
        // includes the php which contains the table for the page
        require_once("../php/resultstable.php");
    ?>

    <div class="pop-up">
        <!-- displays current error, WIP -->

    </div>
</body>

</html>
