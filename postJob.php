<!--	
	Author: 	James Hare
	Date:		January 4, 2018
	File:		postJob.php
-->

<?php

	include("checkLoginStatus.php");		// checks that the user is logged in
	include("restrictToManager.php");		// restricts the content on the page to managers and admin only

	error_reporting(0);
	
	if (isset($_POST['submit'])) {
		
		include("connection.php");		// establishes the database connection.
		
		// variables
		$title = strip_tags($_POST['title']);
		$description = strip_tags($_POST['description']);
		$fullTime = strip_tags($_POST['fullTime']);
		$departmentID = strip_tags($_POST['departmentID']);
		$jobOpen = 1;
		$getLastJobID = 0;
		
		$insertJob = "INSERT INTO `jobs` (Title, Description, Open, FullTime)
						VALUES ('$title', '$description', '1', '$fullTime');";
		
		// the following will check though all the necessary parameters and make sure they are in the correct format
		// for entry into the database.
		// checks that the job title is not left empty
		if (!empty($title)) {
			
			// checks that the job title is not left empty
			if (!empty($description)) {
				
				// checks that fullTime is not left empty
				if (!empty($fullTime)) {
					
					// checks that departmentID is not left empty
					if (!empty($departmentID)) {
						
						if ($con->query($insertJob) === TRUE) {
							
							$getLastJobID = "SELECT `JobID`
												FROM `jobs`
												ORDER BY `JobID` DESC LIMIT 1;";
							$result = mysqli_query($con, $getLastJobID);
							$row = mysqli_fetch_row($result);
							$lastJobID = $row[0];
							
							$linkDepartment = "INSERT INTO `postings` (JobID, DepartmentID)
												VALUES ('$lastJobID', '$departmentID')";
							
							if ($con->query($linkDepartment) === TRUE) {
								
								echo '<center>';
								echo '<p style="color: black;">Success! Your job has been added.</p>';
								echo '</br></br>';
								echo '<p style="color: black;">Add another job by using the for below.</p>';
								echo '</center>';
							
							} else {
								
								echo "Error: " . $linkDepartment . "<br>" . $con->error;
								echo '<center><p style="color: red;">We added your job, but could not find it in the database. Please try again.</p></center>';
							
							}
							
						} else {
							
							echo "Error: " . $insertJob . "<br>" . $con->error;
							echo '<center><p style="color: red;">There was an issue posting your job. Please try again.</p></center>';
						
						}
						
					} else {
						
						// gives an error message if departmentID is left empty
						echo '<p style="color: red;">You must provide the Department ID. Please try again.</p>';
						
					}
					
				} else {
					
					// gives an error message if fullTime is left empty
					echo '<p style="color: red;">You must state whether the job is full time or part time. Please try again.</p>';
					
				}
				
			} else {
				
				// gives an error message if description is left empty
				echo '<p style="color: red;">You must provide a description. Please try again.</p>';
				
			}
			
		} else {
			
			// gives an error message if title is left empty
			echo '<p style="color: red;">You must provide a title. Please try again.</p>';
			
		}
		
		$con->close();		// closes the database connection
		
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Post New Job | Enterprise Career Portal</title>
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
		<h2>Post a New Job</h2> 
		<br><br>
		<p>Use the form below to post a new job on the portal.</p>
		<br>
		<form method="post" action="postJob.php">
		<table>
			<tr>
				<td align="right">Enter a title for the job: </td>
				<td><input type="text" name="title"/></td>
			</tr>
			<tr>
				<td align="right">Describe the job: </td>
				<td><input type="text" name="description"/></td>
			</tr>
			<tr>
				<td align="right">Is the job full time? </td>
				<td>
				<select name="fullTime">
					<option value="1">Yes</option>
					<option value="2">No</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">What is your Department ID? </td>
				<td><input type="text" name="departmentID"/></td>
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
	</div>
	
	<!-- footer -->
	<div class="footer">
		<center>
		<p>©2018 Enterprise. All rights reserved.</p>
		</center>
	</div>
	</body>
</html>