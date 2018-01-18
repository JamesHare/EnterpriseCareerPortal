<?php
	
	session_start();							// makes sure the session is started
	error_reporting(E_ALL & ~E_NOTICE);			// shows any error messages

	// if the employeeID session variable is set
	if(isset($_SESSION['employeeID'])) {
		
		$employeeID = $_SESSION['employeeID'];	// gets the employeeID variable from the session
		$firstName = $_SESSION['firstName'];	// gets the firstName variable from the session
		$accountType = $_SESSION['accountType'];	// checks to see if the user has the privileges to post a new job
		
	} else {
		
		header("Location: index.php");			// redirects to the login page.
		die();
		
	}
?>