<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		addNewDepartment.php
-->

<?php

	include("checkLoginStatus.php");		// checks that the user is logged in
	include("restrictToAdmin.php");			// restricts the content on the page to admin only
	
	error_reporting(0);
	
	// executes if the form has been submitted
	// else it will print a blank form.
	if (isset($_POST['submit'])) {
		
		// variables
		$regCode = strip_tags($_POST['regCode']);
		$regCodeHash = crypt($regCode, 'dsGdpl%d!');
		$departmentID = strip_tags($_POST['departmentID']);
		$departmentName = strip_tags($_POST['departmentName']);
		$cityID = strip_tags($_POST['cityID']);

		include("connection.php");		// sets up the database connection

		// query to add a new employee
		$insertDepartment = "INSERT INTO `departments` (RegCode, DepartmentID, DepartmentName, CityID)
							VALUES ('$regCodeHash', '$departmentID', '$departmentName', '$cityID');";


		// All parameters are passed, we can now enter the new employee into the database
		if ($con->query($insertDepartment) === TRUE) {
			
			echo '</br></br>';
			echo '<center>Success! The new department has been added.</center>';
			echo '</br></br>';
			
		} else {
			
			echo '<center>';
			echo "Error: " . $insertDepartment . "<br>" . $con->error;
			echo '</center>';
		
		}

		// closes the database connection
		$con->close();

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add New Department | Enterprise Career Portal</title>
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
			<h1>Add a New Department</h1>
		</center>
		<h2>Please fill out the form below to add a new department</h2> 
		
		<!-- Asks for department details to add a new department.  -->
		<form method="post" action="addNewDepartment.php">
		<table>
			<tr>
				<td align="right">Enter a new Registration Code (for management registration): </td>
				<td><input type="text" name="regCode"/></td>
			</tr>
			<tr>
				<td align="right">Enter a new Department ID: </td>
				<td><input type="text" name="departmentID"/></td>
			</tr>
			<tr>
				<td align="right">Enter a new Department Name: </td>
				<td><input type="text" name="departmentName"/></td>
			</tr>
			<tr>
				<td align="right">In what city is the department located? </td>
				<td>
				<select name="cityID">
					<option value="1">New York</option>
					<option value="2">Huntsville</option>
					<option value="3">San Antonio</option>
					<option value="4">Denver</option>
				</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" value="Submit" name="submit">
					<input type="reset" value="Reset">
				</td>
			</tr>
		</table>
		</form>
		
		</center>
	</div>
	
	<!-- footer -->
	<div class="footer">
		<center>
		<p>©2018 Enterprise. All rights reserved.</p>
		</center>
	</div>
	</body>
</html>