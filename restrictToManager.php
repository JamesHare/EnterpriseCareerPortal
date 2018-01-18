<?php
	
	// The checkLoginStatus.php script must be included before this.
	
	if($accountType == 2 || $accountType == 3) {
		
		// proceed
		
	} else {
		
		echo '<center>You do not have the required privileges to view this part of the website.</center></br></br>';
		echo '<center>You will be redirected to your dashboard in 5 seconds</center>';
		sleep(5);
		header("Location: dashboard.php");			// redirects to the dashboard.
		
	}

?>