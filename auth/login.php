<?php
session_start();

require_once '../config/database.php';
require_once '../models/User.php';
require_once '../lib/GhLogger.php';
$email    = $_POST['email'];
$password = $_POST['password'];
$message  = 'Email address not found';

$user = User::retrieveByField( 'email', $email, SimpleOrm::FETCH_ONE );
if ( $user ) {

	if ( password_verify( $password, $user->password ) ) {

		$message = 'User found';
		$user_id = $user->id;
		$code    = 200;

		$_SESSION['user_id']      = $user->id;
		$_SESSION['user_name']    = $user->user_name;
		$_SESSION['is_logged_in'] = '1';
		$_SESSION['name']         = $user->first_name . " " . $user->last_name;
		$_SESSION['email']        = $email;
		$_SESSION['group']        = $user->group;

		GhLogger::writeLog( $email . " Logged in" );


	} else {

		GhLogger::writeLog( "Wrong login attempt by " . $email );
		$message = 'Password doesn\'t match';
		$user_id = 0;
		$code    = 300;

	}
} else {

	$user_id = 0;
	$code    = 400;
}

echo json_encode( [ 'message' => $message, 'user_id' => $user_id, 'code' => $code ] );

?>