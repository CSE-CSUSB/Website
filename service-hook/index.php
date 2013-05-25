<?php

$ip = ip2long($_SERVER['REMOTE_ADDR']);

$github = array(
    "204.232.175.64/27",
    "192.30.252.0/22"
);

function cidr($ip, $range)
{
	foreach($range as $cidr) {
		$parts = explode("/", $cidr);
		$check = ip2long($parts[0]);
		$mask = 256 - pow(2, (int)$parts[1]);

		if ($check & $mask == $ip & $mask)
			return true;
	}

	return false;
}

if (cidr($ip, $github) and isset($_POST['payload'])) {
	shell_exec( 'cd ../../dev.cse-club.com/ && git reset --hard HEAD && git pull' );
	shell_exec( 'cd ../../cse-club.com/ && git reset --hard HEAD && git pull' );
} else {
	header("Location: http://cse-club.com/");
}
