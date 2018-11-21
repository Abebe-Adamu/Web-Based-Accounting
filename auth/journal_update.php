<?php
session_start();


require_once '../config/database.php';
require_once '../models/Journal.php';
require_once '../models/Reference.php';
require_once '../lib/GhLogger.php';

$ref_id = $_POST['reference_id'];
$status = $_POST['status'];
$reason = $_POST['reason'];


Journal::updateJournals( $ref_id, $status );
Reference::updateReference( $ref_id, $status, $reason );

GhLogger::writeLog( $_SESSION['email'] . " Changed the status of the Journal  : " . $ref_id . " to " . $status );

echo "message";





