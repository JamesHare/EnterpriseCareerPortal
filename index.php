<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		index.php
-->
<?php

	session_start();							// makes sure the session is started
	error_reporting(E_ALL & ~E_NOTICE);			// shows any error messages

	// if the employeeID session variable is set (if the user is already logged in)
	if(isset($_SESSION['employeeID'])) {
		
		$employeeID = $_SESSION['employeeID'];	// gets the employeeID variable from the session
		$firstName = $_SESSION['firstName'];	// gets the firstName variable from the session
		$accountType = $_SESSION['accountType'];	// checks to see if the user has the privileges to post a new job
		header("Location: dashboard.php");			// redirects to the dashboard page.
		
	}

	if (isset($_POST['submit'])) {
		
		include("connection.php");						// to establish the database connection
		
		$postedEmployeeID = strip_tags($_POST['employeeID']);	// sets the variable and strips any tags to prevent SQL Injection
		$employeeID = intval($postedEmployeeID);		// establishes the var as a number so that we can add it to a query
		$password = strip_tags($_POST['password']);		// sets the variable and strips any tags to prevent SQL Injection
		$suppliedHash = crypt($password, 'dsGdpl%d!');				// encrypts the supplied password
		
		// gets the known password hash from the database
		$hashReq = "SELECT `FirstName`, `Auth`, `AccountType`
					FROM `employees`
					WHERE employeeID = $employeeID LIMIT 1";

		$result = mysqli_query($con, $hashReq);
		
		if ($result) {
			
			$row = mysqli_fetch_row($result);
			$firstName = $row[0];
			$databaseHash = $row[1];
			$accountType = $row[2];
			
		}
		
		mysqli_close($con);
		
		if (hash_equals($databaseHash, crypt($password, 'dsGdpl%d!'))) {
			
			$_SESSION['employeeID'] = $employeeID;
			$_SESSION['firstName'] = $firstName;
			$_SESSION['accountType'] = $accountType;
			header('Location: dashboard.php');
			
		} else {
			
			echo '</br></br>';
			echo '<center><p style=color: red;">Incorrect Employee ID or Password. Please try again.</p><center>';

		}
	}
?>

<html>
	<head>
		<title>Log In | Enterprise Career Portal</title>
		<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Description" content="Enterprise Career Portal. Shape your career. Find the best employees for your business"/>
		<meta name="keywords" content="enterprise career portal, job board, careers, job postings, open positions, staffing,"/>
		<meta name="robots" content="index,follow"/>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<center>		
		
		<!-- Login Box -->
		<div class="loginForm">
			<center>
			<h3>Welcome to the Enterprise Career Portal</h3>
			<h5>Please log in using the form below</h5>
			<table>
				<form method="post" action="index.php" >
				<tr>
					<th>EmployeeID: </th>
					<td><input type="text" name="employeeID"></td>
				</tr>
				<tr>
					<th>Password: </th>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" name="submit" value="Log In"></td>
				</tr>
				<tr>
					<td></br></td>
					<td></br></td>
				</tr>
				<tr>
					<td><center><a href="addNewEmployee.php">Register</a></center></td>
					<td><center><a href="about.php">About</a></center></td>
				</tr>
				</form>
			</table>
			</center>
		</div>
		
		</center>
	
	<!-- footer -->
	<div class="footer">
		<center>
		<p>©2018 Enterprise. All rights reserved.</p>
		<p>NOTICE OF CONFIDENTIALITY<p>
		<p>This material is internal to this Enterprise and is intended
		for the use of the individual or entity to which it is addressed, and
		may contain information that is privileged, confidential and exempt from
		disclosure under applicable laws. If the reader of this material is not
		the intended recipient, or the employee or agent responsible for
		delivering the material to the intended recipient, you are hereby notified
		that any dissemination, distribution or copying of this communication is
		strictly prohibited.</p>
		</center>
	</div>
	</body>
</html>