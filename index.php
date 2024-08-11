<html>
<html lang="en">

<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		require_once('html/header-loggedin.html');
	} else {
		require_once('html/header.html');
	}

	require "html/head.html";
	require "html/footer.html";
?>

<head>
    <title>Database Test Website</title>
    <meta charset="UTF-8">
    <meta name="author" content="somjdev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/DB.ico">

    <link rel="stylesheet" href="/css/style.css">

    <!-- App Icons https://github.com/FortAwesome/Font-Awesome/tree/6.x https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
	
	<?php 
		// if the user is logged in send them to the userpage
		if (isset($_SESSION['user_id'])) {
			header("Location: html/userpage.php");
			exit;
		} 
	?>

</body>

</html>