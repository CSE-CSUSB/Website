<?php
	// Data file
	$res_file = "../../potluck.txt";
		
	// Input check
	if(empty($_POST['cid']) ||
	   empty($_POST['name'])) {
		header("Refresh:3; /events/picnic", true, 303);
		die("Please enter your name and Coyote ID. You will be sent back to the form.");
	}

	// Add reservation to file
	file_put_contents($res_file, $_POST['cid'] . " - " . $_POST['name'] . " - " . $_POST['items'] . "\n", FILE_APPEND | LOCK_EX);
		    
	echo "You have successfully registered!";

	header("Refresh:3; url=http://cse-club.com", true, 303);
