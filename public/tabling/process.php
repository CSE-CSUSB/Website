<?php
	// Data file
	$res_file = "../tabling.txt";

	// Input check
	if(empty($_POST['cid'])   ||
	   empty($_POST['name'])  ||
	   empty($_POST['email']) ||
	   empty($_POST['times'])) {
		header("Refresh:3; tabling.html", true, 303);
		die("Please enter your name, Coyote ID, email address, and your availability to table. You will be sent back to the form.");
	}

	// Add info to file
	$entry  = $_POST['member'] ? "---\n" : "--- Nonmember \n";
	$entry .= $_POST['cid'] . " - " . $_POST['name'] . " - " . $_POST['email'] . "\nTimes:\n" . $_POST['times'] . "\n";

	file_put_contents($res_file, $entry, FILE_APPEND | LOCK_EX);
		    
	echo "Your information has been saved.";

	header("Refresh:3; url=http://cse-club.com", true, 303);
