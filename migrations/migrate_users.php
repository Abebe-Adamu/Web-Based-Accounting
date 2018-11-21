<?php



$password = password_hash( 'abc123', PASSWORD_BCRYPT );
$sql      = "INSERT INTO user
			(`user_name`, `first_name`, `last_name`, `password`, `group`, `email`) 
			VALUES
			('john', 'john', 'doe', '$password', 'user', 'user@example.com')
		";
if ( $db->query( $sql ) ) {
	echo "user john has been added successfully<br>";
} else {
	echo "failed to add user john to the user table<br>";
	echo $db->error;
}


$password = password_hash( 'abc123', PASSWORD_BCRYPT );
$sql      = "INSERT INTO user
			(`user_name`, `first_name`, `last_name`, `password`, `group`, `email`) 
			VALUES
			('admin', 'jane', 'doe', '$password', 'admin', 'admin@example.com')
		";
if ( $db->query( $sql ) ) {
	echo "user admin has been added successfully<br>";
} else {
	echo "failed to add user admin to the user table<br>";
	echo $db->error;
}


$password = password_hash( 'abc123', PASSWORD_BCRYPT );
$sql      = "INSERT INTO user
			(`user_name`, `first_name`, `last_name`, `password`, `group`, `email`) 
			VALUES
			('manager', 'ron', 'doe', '$password', 'manager', 'manager@example.com')
		";
if ( $db->query( $sql ) ) {
	echo "user ron has been added successfully<br>";
} else {
	echo "failed to add user ron to the user table<br>";
	echo $db->error;
}

?>