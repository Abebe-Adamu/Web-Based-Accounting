<?php


session_start();

require_once '../config/database.php';
require_once '../models/Account.php';
require_once '../lib/GhLogger.php';

$account_number  = $_POST['account_number'];
$name            = $_POST['name'];
$normal_side     = $_POST['normal_side'];
$initial_balance = $_POST['initial_balance'];
$comments        = $_POST['comments'];

//echo json_encode( [ 'id' => $id ] );

if ( isset( $_POST['id'] ) ) {


	$account = Account::retrieveByPK( $_POST['id'] );
	$active  = $_POST['active'];

	$account->name            = $name;
	$account->account_number  = $account_number;
	$account->normal_side     = $normal_side;
	$account->initial_balance = $initial_balance;
	$account->comments        = $comments;
	$account->active          = $active;

	$account->save();

	$message = "Account updated";

	echo json_encode( [ 'code' => 200, 'message' => $message ] );


} else {


	$account = new Account;

	$type     = $_POST['type'];
	$sub_type = $_POST['sub_type'];

	$account->name            = $name;
	$account->type            = $type;
	$account->sub_type        = $sub_type;
	$account->account_number  = $account_number;
	$account->normal_side     = $normal_side;
	$account->initial_balance = $initial_balance;
	$account->comments        = $comments;
	$account->active          = 'Y';

	if ( $account->name != "" ) {


		$account->save();
	}

	if ( isset( $account->id ) && $account->id > 0 ) {

		$code    = 200;
		$message = 'Account created successfully : ' . $account->account_number;
		GhLogger::writeLog( $_SESSION['email'] . " Created a New Account : " . $account_number );
	} else {
		$code    = 400;
		$message = 'Account creation failed : ';
		GhLogger::writeLog( $_SESSION['email'] . " Failed to create a New Account : " );
	}

	echo json_encode( [ 'code' => 200, 'message' => $message ] );
}