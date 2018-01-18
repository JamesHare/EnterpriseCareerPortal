<?php

// establishes a database connection

$con = mysqli_connect("localhost", "[USERNAME OMITTED]", "[PASSWORD OMITTED]", "jobboard");

if (!$con) {
	
    echo 'Failed to connect to the database: ' . mysqli_connect_error();
	
}
?>