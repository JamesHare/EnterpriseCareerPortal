<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		addNewEmployee.php
-->

<?php
	error_reporting(0);
	
	// executes if the form has been submitted
	// else it will print a blank form.
	if (isset($_POST['submit'])) {
		
		// variables
		$firstName = strip_tags($_POST['firstName']);
		$lastName = strip_tags($_POST['lastName']);
		$password = strip_tags($_POST['password']);
		$passHash = crypt($password, 'dsGdpl%d!');
		$departmentID = strip_tags($_POST['departmentID']);
		$phoneNumber = strip_tags($_POST['phoneNumber']);
		$email = strip_tags($_POST['email']);
		$getLastEmployeeID = 0;

		include("connection.php");		// sets up the database connection

		// query to add a new employee
		$insertEmployee = "INSERT INTO `employees` (FirstName, LastName, Phone, Email, DepartmentID, AccountType, Auth)
							VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$departmentID', '1', '$passHash');";

		// the following will check though all the necessary parameters and make sure they are in the correct format
		// for entry into the database.
		// checks that the users first name is not left empty
		if (!empty($firstName)) {
			
			// checks that the users last name is not left empty
			if (!empty($lastName)) {
				
				// checks that the users phone number is valid
				if (!empty($phoneNumber) || ctype_digit($phoneNumber) || strlen($phoneNumber) == 10) {
					
					// checks that the users email is not left empty
					if (!empty($email)) {
						
						// checks that both the users names only contain alpha characters
						if (ctype_alpha($firstName) && ctype_alpha($lastName)) {
							
							// checks that the users password is not left empty
							if (!empty($password)) {
								
								// checks that the users first name is not left empty
								if (strlen($password) >= 8) {
									
									// All parameters are passed, we can now enter the new employee into the database
									if ($con->query($insertEmployee) === TRUE) {
										
										// Gets the last EmployeeID that was just entered
										$getLastEmployeeID = "SELECT `EmployeeID`
																FROM `employees`
																ORDER BY `EmployeeID` DESC LIMIT 1;";
										$result = mysqli_query($con, $getLastEmployeeID);
										$row = mysqli_fetch_row($result);
										$lastEmployeeID = $row[0];
						
										echo '<center>';
										echo '<p style="color: Black;">Success! You have created a new account.</p>';
										echo '</br></br>';
										echo '<p style="color: Black;">Your new Employee ID is ' . $lastEmployeeID . '</p>';
										echo '</br></br>';
										echo '<p style="color: Black;">Please click the Log In button in the sidebar to proceed to your dashboard.</p>';
										echo '</br></br></br>';
										echo '</center>';
										
									} else {
										
										echo '<center>';
										echo "Error: " . $insertEmployee . "<br>" . $con->error;
										echo '</br></br><button onclick="history.go(-1);">Click here to go back.</button>';
										echo '</center>';
									
									}
									
								} else {
									
									// gives an error message if password is shorter than 8 characters
									echo '<center><p style="color: red;">Your password must be 8 characters or longer. Please try again.</p></center>';
									
								}
								
							} else {
								
								// gives an error message if password is left empty
								echo '<center><p style="color: red;">You must enter a password. Please try again.</p></center>';
								
							}
							
						} else {
							
							// gives an error message if users names contain anything other that alpha characters
							echo '<center><p style="color: red;">Names can only contain valid characters (A-Z a-z). Please try again.</p></center>';
							
						}
						
					} else {
						
						// gives an error message if email is left empty
						echo '<center><p style="color: red;">Email cannot be empty. Please try again.</p></center>';
						
					}
					
				} else {
					
					// gives an error message if phone number is not valid
					echo '<center><p style="color: red;">You must enter a valid phone number. Please try again.</p></center>';
					
				}
				
			} else {
				
				// gives an error message if last name is left empty
				echo '<center><p style="color: red;">Last Name cannot be empty. Please try again.</p></center>';

			}
			
		} else {
			
			// gives an error message if first name is left empty
			echo '<center><p style="color: red;">First Name cannot be empty. Please try again.</p></center>';

		}

		// closes the database connection
		$con->close();

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add New Employee | Enterprise Career Portal</title>
		<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Description" content="Enterprise Career Portal. Shape your career. Find the best employees for your business"/>
		<meta name="keywords" content="enterprise career portal, job board, careers, job postings, open positions, staffing,"/>
		<meta name="robots" content="index,follow"/>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
	<!-- Sidebar -->
	<div class="sidenav">
		<a href="index.php">Log In</a>
	</div>
	
	<!-- main part of page -->
	<div class="main">
		<center>
			<h1>Create a New Account</h1>
		</center>
		<h2>Please enter your details to create a new account</h2> 
		Registering as a manager? <a href="addNewManager.php">Click Here</a>!
		
		<!-- Asks for employee details to create a new account.  -->
		<form method="post" action="addNewEmployee.php">
		<table>
			<tr>
				<td align="right">First Name: </td>
				<td><input type="text" name="firstName"/></td>
			</tr>
			<tr>
				<td align="right">Last Name: </td>
				<td><input type="text" name="lastName"/></td>
			</tr>
			<tr>
				<td align="right">Enter a new password (must be 8 or more characters long): </td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td align="right">What is your Department ID? </td>
				<td>
				<select name="departmentID">
					<option value="120">120</option>
					<option value="125">125</option>
					<option value="130">130</option>
					<option value="135">135</option>
					<option value="140">140</option>
					<option value="145">145</option>
					<option value="150">150</option>
					<option value="155">155</option>
					<option value="160">160</option>
					<option value="165">165</option>
					<option value="170">170</option>
					<option value="175">175</option>
					<option value="180">180</option>
					<option value="185">185</option>
					<option value="190">190</option>
					<option value="195">195</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">Enter your phone number (with no - or spaces): </td>
				<td><input type="text" name="phoneNumber"/></td>
			</tr>
			<tr>
				<td align="right">Enter your email address: </td>
				<td><input type="text" name="email"/></td>
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