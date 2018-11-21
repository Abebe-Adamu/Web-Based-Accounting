<?php


require_once '../config/database.php';
require_once '../models/User.php';
require_once '../lib/GhLogger.php';
$user_name  = $_POST['user_name'];
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$email      = $_POST['email'];
$password   = $_POST['password'];

$message = 'Email address not found';

$user = User::retrieveByField( 'email', $email, SimpleOrm::FETCH_ONE );

if ( $user ) {

	$message = 'Email address already in use';
	$code    = 500;

} else {

	$user             = new User;
	$user->user_name  = $user_name;
	$user->first_name = $first_name;
	$user->last_name  = $last_name;
	$user->email      = $email;
	$user->password   = password_hash( $password, PASSWORD_BCRYPT );

	$user->save();

	GhLogger::writeLog( $email . " Created a new account" );
	$message = "User created";
	$code    = 200;

}

echo json_encode( [ 'message' => $message, 'code' => $code ] );

?>