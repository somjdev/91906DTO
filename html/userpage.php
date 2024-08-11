<!DOCTYPE html>
<html lang="en">

<?php
    include "head.html";

	session_start();

	if (isset($_SESSION['user_id'])) {
		require_once('../html/header-loggedin.html');
	} else {
		header("Location: loginform.php");
	}

    require "../php/sidebar.php";

	require "../html/footer.html";
?>

<body>
    <?php
        require_once("../php/resultstable.php");
    ?>

    <div class="pop-up">
        <!-- displays current error, WIP -->

    </div>
</body>

</html>