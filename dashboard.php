<!DOCTYPE html>
<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		dashboard.php
	Description: This file presents the home page dashboard to
				 the logged in user.
-->

<?php

	include("checkLoginStatus.php");		// checks that the user is logged in

?>

<html>
	<head>
		<title>Dashboard | Enterprise Career Portal</title>
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
				<h1>Welcome, <?php echo $firstName ?></h1>
			</center>
			<h2>My Dashboard</h2> 
			
			<!-- TODO: Add the dashboard elements -->
			
		</div>
	
	<!-- footer -->
	<div class="footer">
		<center>
		<p>©2018 Enterprise. All rights reserved.</p>
		</center>
	</div>
	</body>
</html>