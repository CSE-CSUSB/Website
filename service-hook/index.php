<?php

if ( $_POST['payload'] ) {
	shell_exec( 'cd ../../dev.cse-club.com/ && git reset --hard HEAD && git pull' );
	shell_exec( 'cd ../../cse-club.com/ && git reset --hard HEAD && git pull' );
}
