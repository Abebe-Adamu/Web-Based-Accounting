<?php


session_start();

require_once '../lib/GhLogger.php';
GhLogger::writeLog( $_SESSION['email'] . " Logged out" );
session_destroy();
header( 'Location: /login.php' );

?>


