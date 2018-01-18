<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		about.php
	Description: This page provides information about the portal to the
				 user if they are logged into the system. Otherwise, it
				 will redirect to an external about page.
-->

<?php
	
	session_start();							// makes sure the session is started
	error_reporting(E_ALL & ~E_NOTICE);			// shows any error messages

	// if the employeeID session variable is set
	if(isset($_SESSION['employeeID'])) {
		
		$employeeID = $_SESSION['employeeID'];	// gets the employeeID variable from the session
		$firstName = $_SESSION['firstName'];	// gets the firstName variable from the session
		$accountType = $_SESSION['accountType'];	// checks to see if the user has the privileges to post a new job
		
	} else {
		
		header("Location: aboutExternal.php");	// redirects to an external about page.
		die();
		
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>About | Enterprise Career Portal</title>
		<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Description" content="Enterprise Career Portal. Shape your career. Find the best employees for your business"/>
		<meta name="keywords" content="enterprise career portal, job board, careers, job postings, open positions, staffing,"/>
		<meta name="robots" content="index,follow"/>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		
		<!-- Sidebar -->
		<!-- Includes the content for the sidebar -->
		<?php include("sidebar.php"); ?>
		<!-- End Sidebar -->
		
		<!-- main part of page -->
		<div class="main">
			<center>
				<h1>Enterprise Career Portal</h1>
			</center>
			
			<h2>About</h2> 
				<p>The Enterprise Career Portal is a project written by James Hare.</br>
				In this project, I wanted to stretch my skills in both web based development</br>
				and database management.</p>
				</br>
				<p>The primary features that I wanted to include was a way for users to create a new</br>
				account, login using a password, post a job, search for jobs, apply to jobs and view</br>
				applicants for a job</p>
				</br>
				<p>The database is hosted on a local LAMP server and cannot be accessed over</br>
				the Internet for security reasons.</p>
		</div>
		
		<!-- footer -->
		<div class="footer">
			<center>
			<p>©2018 Enterprise. All rights reserved.</p>
			</center>
		</div>
	</body>
</html>