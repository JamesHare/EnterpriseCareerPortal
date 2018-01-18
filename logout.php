<!--	
	Author: 	James Hare
	Date:		January 7, 2018
	File:		logout.php
	Description: This file handles the logout procedure
				 when the user chooses an option to logout.
-->

<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();						// makes sure the session is started

session_destroy();						// destroys the session and saved variables

header("Location: index.php");			// redirects to the login page

?>