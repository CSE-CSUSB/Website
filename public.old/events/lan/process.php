<?php
	// Data file
	$res_file = "../../../lanres.txt";
	
	// Check for agreement
	/*if(!isset($_POST['agree'])) {
		header("Refresh:3; /events/lan", true, 303);
		die("You need to be able to pay the fee in order to attend the event.");
	}*/
	
	/*// Input check
	if(empty($_POST['cid']) ||
	   empty($_POST['name']) ||
		 empty($_POST['club'])) {
		header("Refresh:3; /events/lan", true, 303);
		die("Please enter your name, Coyote ID, and select your club affiliation. You will be sent back to the form.");
	}

	// Add reservation to file
	file_put_contents($res_file, $_POST['club'] . "," . $_POST['cid'] . "," . $_POST['name'] . "," . $_POST['pc'] . "\n", FILE_APPEND | LOCK_EX);
		    
	echo "Your reservation has been made!";

	header("Refresh:3; url=http://cse-club.com", true, 303);*/
