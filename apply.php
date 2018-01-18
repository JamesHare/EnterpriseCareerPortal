<!--	
	Author: 	James Hare
	Date:		January 5, 2018
	File:		viewAllJobs.php
-->

<?php

	include("checkLoginStatus.php");		// checks that the user is logged in

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Apply | Enterprise Career Portal</title>
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
		$postedJobID = strip_tags($_POST['jobID']);	// strips away any tags to prevent link injection
		$jobID = intval($postedJobID);				// sets the jobID as an integer
		
		include("connection.php");		// sets up the database connection
		
		// a query to get the details about the job matching the jobID
		$getJobDetails = "SELECT j.Title, c.City, j.Description, j.FullTime, j.JobID
							FROM jobs j
							INNER JOIN postings p ON p.JobID = j.JobID
							INNER JOIN departments d ON d.DepartmentID = p.DepartmentID
							INNER JOIN cities c ON c.CityID = d.CityID
							WHERE j.JobID = $jobID";
		
		$result = mysqli_query($con, $getJobDetails);	// gets the results of the query
		
		mysqli_close($con);								// closes the connection to the database
		
		echo 'You are applying for job number ' . $jobID . "</br></br>";
		
		// Checks that the job is still in the database.
		if(!$result) {
			
			die("There was a problem connecting to the database."); 
			
		} elseif (mysqli_num_rows($result) == 0) {
			
			echo 'Sorry, this job is no longer open.';
			
		} else {
			
			// process results 
			// use an associative array to extract the next record from the result
			// until no results are left 
			// $row is the associative array 
			?> 
			<form action="applied.php" method="post">
			<table>
			<?php 
			//each time the loop repeats, $row is assigned the next record in the result set 
			//as an associative array 
			while($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td align="left"><strong>Title: </strong></td>
				<td align="left"><?php echo $row['Title']?></td>
			</tr>
			<tr>
				<td align="left"><strong>City: </strong></td>
				<td align="left"><?php echo $row['City']?></td>
			</tr>
			<tr>
				<td align="left"><strong>Description: </strong></td>
				<td align="left"><?php echo $row['Description']?></td>
			</tr>
			<tr>
				<td align="left"><strong>Full Time: </strong></td>
				<?php if ($row['FullTime'] = 0) { ?>
				<td align="left"><?php echo 'No'?></td>
				<?php } else { ?>
				<td align="left"><?php echo 'Yes'?></td>
				<?php } ?>
			</tr>
			</br></br>
			<tr>
				<td>
					<!-- empty for spacing -->
				</td>
				<td align="left">
					<form action="applied.php" method="post">
						<input type="hidden" value="<?php echo $row['JobID']?>" name="jobID" />
						<input type="submit" value="Confirm Application" />
					</form>
				</td>
			</tr> 
			<?php 
				}
			}
			?> 
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