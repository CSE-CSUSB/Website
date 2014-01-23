<?php

// Data files
$member_file = "../members.txt";
$votes_file = "../votes.txt";
$candidates_file = "../candidates.txt";

// Sanity check on input variables
if (empty($_POST['cid']) or 
    empty($_POST['treasurer']) or 
    empty($_POST['webmaster']) or 
    empty($_POST['information']) or 
    empty($_POST['event'])) {
    die("Invalid vote. Make sure you filled out the form completely.");
}

// Build member list
$cid = ltrim($_POST['cid'], '0');
$members = file($member_file, FILE_IGNORE_NEW_LINES);

// Throttle votes to prevent cheating
sleep(0.5);

// Validate coyote id
if (array_search($cid, $members) === False) {
    echo "Either you are not a member, or your vote has already been cast.";
} else {
    $candidates = file($candidates_file, FILE_IGNORE_NEW_LINES);

    // Ensure valid vote entries
    $treasurer = array_intersect(array($_POST['treasurer']), $candidates)[0];
    $webmaster = array_intersect(array($_POST['webmaster']), $candidates)[0];
    $information = array_intersect(array($_POST['information']), $candidates)[0];
    $event = array_intersect(array($_POST['event']), $candidates)[0];

    // Build vote string
    $vote = "{$cid} - {$treasurer}, {$webmaster}, {$information}, {$event}\n";

    // Remove member's voting capability
    $members = array_diff($members, array($cid));

    // Save results
    file_put_contents($votes_file, $vote, FILE_APPEND | LOCK_EX);
    file_put_contents($member_file, implode("\n", $members), LOCK_EX);
    
    echo "Vote has been cast, thank you!";
}




