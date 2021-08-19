<?php
	session_start();

	// Logout
	if (isset($_SESSION["memberId"])) {
		$_SESSION = array();
		session_destroy();
        
        /*if (isset($_COOKIE["memberId"])) {
            $time = time() — 3600 * 24 * 30;
            setcookie("memberId", "", $time);
            setcookie("profileIcon", "", $time);
        }*/
	}

	// Redirect the user to the home page
	header("location: index.php");
?>