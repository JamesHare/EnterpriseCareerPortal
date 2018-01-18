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
		<title>View All Jobs | Enterprise Career Portal</title>
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
			<h1>View All Jobs</h1>
		</center>
		<br><br><br>
		<?php
		
		include("connection.php");		// sets up the database connection
		
		$getOpenJobs = "SELECT j.Title, c.City, j.Description, j.FullTime, j.JobID
							FROM jobs j
							INNER JOIN postings p ON p.JobID = j.JobID
							INNER JOIN departments d ON d.DepartmentID = p.DepartmentID
							INNER JOIN cities c ON c.CityID = d.CityID
							WHERE j.Open = 1";
							
		$result = mysqli_query($con, $getOpenJobs);
		mysqli_close($con);
		
		// tests for the results before processing them 
		if(!$result) {
			
			die("Couldn't run query");
			
		}
		if(mysqli_num_rows($result) == 0) {
			
			print("No records were found with the query");
			
		} else {
			// process results 
			// use an associative array to extract the next record from the result
			// until no results are left 
			// $row is the associative array 
			?> 
			<center>
			<table>
			<tr>
				<th align="left">Title</th>
				<th align="left">City</th>
				<th align="left">Description</th>
				<th align="left">Full Time?</th>
				<th align="left"></th>
			</tr>
			<?php 
			//each time the loop repeats, $row is assigned the next record in the result set 
			//as an associative array 
			while($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td align="left"><?php echo $row['Title']?></td>
				<td align="left"><?php echo $row['City']?></td>
				<td align="left"><?php echo $row['Description']?></td>
				<?php if ($row['FullTime'] == 2) { ?>
				<td align="left"><?php echo 'No'?></td>
				<?php } else { ?>
				<td align="left"><?php echo 'Yes'?></td>
				<?php } ?>
				<td align="left">
					<form action="apply.php" method="post">
						<input type="hidden" value="<?php echo $row['JobID']?>" name="jobID" />
						<input type="submit" value="Apply" name="submit" />
					</form>
				</td>
			</tr> 
			<?php 
			}
			?>
			</table>
			</center>
		<?php
		}
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