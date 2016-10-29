<?php
	// Data file
	$res_file = "../../tutoring.csv";

	// Input check
	if(empty($_POST['name'])  ||
	   empty($_POST['tutor']) ||
	   empty($_POST['classes'])) {
		header("Refresh:3; index.html", true, 303);
		die("Please fill in your name, your tutor and the classes you recieved tutoring for.");
	}

	$entry = $_POST['name'] . "," . $_POST['tutor'] . "," . time() . "," . ($_POST['member'] ? "y" : "n") . "," . $_POST['classes'] . "\n";

	file_put_contents($res_file, $entry, FILE_APPEND | LOCK_EX);
		    
	echo "You have been signed in!";

	header("Refresh:3; url=http://cse-club.com", true, 303);
