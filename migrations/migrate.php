<?php


require_once dirname( __FILE__ ) . '/../config/database.php';

//create tables

$table = 'account';

$db->query( "DROP TABLE IF EXISTS $table" );

$sql = "CREATE TABLE `$table`(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    account_number VARCHAR(30) NOT NULL,
    name VARCHAR(30) NOT NULL,
    normal_side VARCHAR(30) NOT NULL,
    type ENUM('asset', 'liability', 'equity', 'revenue', 'expenses') DEFAULT 'asset',
    sub_type VARCHAR(30) DEFAULT NULL,
    initial_balance FLOAT(30) DEFAULT 0.0,
    comments VARCHAR(64) DEFAULT 'No Comments',
    active ENUM('Y', 'N') DEFAULT 'Y'
)";

if ( $db->query( $sql ) ) {
	echo strtoupper( "$table table created successfully<br>" );
} else {
	echo strtoupper( "$table table cannot be created<br>" );
}


$table = 'user';

$db->query( "DROP TABLE IF EXISTS $table" );

$sql = "CREATE TABLE `$table`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(30) NOT NULL,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30) NOT NULL,
    `password` VARCHAR(63) NOT NULL,
    `group` ENUM('user', 'manager', 'admin') DEFAULT 'user',
    `active` TINYINT(1) DEFAULT 1,
    `email` VARCHAR(70) NOT NULL UNIQUE
)";

if ( $db->query( $sql ) ) {
	echo strtoupper( "$table table created successfully<br>" );
} else {
	echo strtoupper( "$table table cannot be created<br>" );
}

$table = 'journal';

$db->query( "DROP TABLE IF EXISTS $table" );

$sql = "CREATE TABLE `$table`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `account_name` VARCHAR(30) NOT NULL,
    `reference_id` INT(11) DEFAULT 0,
    `debit` FLOAT(30) DEFAULT NULL,
    `credit` FLOAT(30) DEFAULT NULL,
    `status` ENUM('PENDING', 'APPROVED', 'REJECTED') DEFAULT 'PENDING'
)";

if ( $db->query( $sql ) ) {
	echo strtoupper( "$table table created successfully<br>" );
} else {
	echo strtoupper( "$table table cannot be created<br>" );
	echo $db->error;
}


$table = 'reference';

$db->query( "DROP TABLE IF EXISTS $table" );

$sql = "CREATE TABLE `$table`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `date` VARCHAR(15) NOT NULL,
    `file` VARCHAR(127) DEFAULT 0,
    `description` VARCHAR(63) DEFAULT NULL,
    `status` ENUM('PENDING', 'APPROVED', 'REJECTED') DEFAULT 'PENDING',
    `reason` VARCHAR(63) DEFAULT NULL

)";

if ( $db->query( $sql ) ) {
	echo strtoupper( "$table table created successfully<br>" );
} else {
	echo strtoupper( "$table table cannot be created<br>" );
	echo $db->error;
}


//insert dummy data for user table
require_once 'migrate_users.php';

//insert dummy data to the account table
require_once 'migrate_accounts.php';

//insert dummy data to the reference table
require_once 'migrate_references.php';

//insert dummy data to the journal table
require_once 'migrate_journals.php';

