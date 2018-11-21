<?php


// Include the Simple ORM class
include_once dirname( __FILE__ ) . '/../lib/SimpleOrm.class.php';
include_once "config.php";

// Connect to the database using mysqli
$db = new mysqli( DB_HOST, DB_USER, DB_PASS );

if ( $db->connect_error ) {
	die( sprintf( 'Unable to connect to the database. %s', $db->connect_error ) );
}

// Tell Simple ORM to use the connection you just created.
SimpleOrm::useConnection( $db, DB_NAME );
