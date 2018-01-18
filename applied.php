<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		applied.php
-->

<?php

	include("checkLoginStatus.php");		// checks that the user is logged in

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Success! | Enterprise Career Portal</title>
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
			<h1>Apply</h1>
		</center>
		<br><br>
		<?php
			// variables
			$employeeID = intval($employeeID);		// sets the $employeeID as an integer
			$jobID = intval($_POST['jobID']);
			
			include("connection.php");		// sets up the database connection
			
			// Query to add application to the database
			$insertApplication = "INSERT INTO `applications` (EmployeeID, JobID)
								VALUES ('$employeeID', '$jobID')";
			
			if ($con->query($insertApplication) === TRUE) {
				
				echo '</br></br>';
				echo 'Your application has been received.';
				echo '</br></br>';
				echo 'A representative will be in touch soon.';
				
			} else {
				
				echo 'There was a problem receiving your application. Please try again.';
				echo "Error: " . $insertApplication . "<br>" . $con->error;
				
			}

			// closes the database connection
			$con->close();
		?>
		
	</div>
	
	<!-- footer -->
	<div class="footer">
		<center>
		<p>©2018 Enterprise. All rights reserved.</p>
		</center>
	</div>
	</body>
</html>