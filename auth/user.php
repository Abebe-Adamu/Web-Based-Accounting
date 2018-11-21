<?php

session_start();

require_once '../config/database.php';
require_once '../models/User.php';
require_once '../lib/GhLogger.php';
$id   = $_POST['user'];
$role = $_POST['role'];


//echo json_encode( [ 'id' => $id ] );

$user = User::retrieveByPK( $id );

$user->group = $role;

$user->save();

$code    = 200;
$message = 'User role updated successfully : ' . $user->group;

GhLogger::writeLog( "Account role for " . $user->email . " was updated to " . $role . " by " . $_SESSION['group'] . " - " . $_SESSION['email'] );

echo json_encode( [ 'code' => 200, 'message' => $message ] );
