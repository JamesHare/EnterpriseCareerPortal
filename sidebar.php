<?php
	echo '<div class="sidenav">';
		echo '<a href="dashboard.php">Dashboard</a>';
		echo '<a href="about.php">About Project</a>';
		
		// if the user is a manager or an admin
		if ($accountType == 2 || $accountType == 3) {
			
			// gives the option to post a new job
			echo '<a href="postJob.php">Post a Job</a>';
		
		}
		
		// if the user is an admin
		if ($accountType == 3) {
			
			// gives the option to add a new department
			echo '<a href="addNewDepartment.php">Add New Department</a>';
			
		}
		
		echo '<a href="viewAllJobs.php">View All Jobs</a>';
		echo '<a href="logout.php">Logout</a>';
	echo '</div>';
?>