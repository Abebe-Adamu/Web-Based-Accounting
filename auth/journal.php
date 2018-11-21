<?php


session_start();

require_once '../config/database.php';
require_once '../models/Journal.php';
require_once '../models/Reference.php';
require_once '../lib/GhLogger.php';


//print_r( $_POST['data'] );
//var_dump( $_FILES );

$journal_entries = ( explode( ',', $_POST['data'] ) );
parse_str( $_POST['options'], $options );
parse_str( $_POST['extra'], $extra );


$reference              = new Reference;
$reference->id          = $extra['reference_number'];
$reference->date        = $extra['date'];
$reference->description = $options['description'];
$reference->status      = 'PENDING';

$flag = false;

if ( ! Reference::exists( $reference->id ) ) {


	$reference->save();

	if ( ! empty( $_FILES['file'] ) ) {
		$path = "../uploads/";
		$path = $path . 'file_' . $reference->id . '_' . basename( $_FILES['file']['name'] );
		if ( move_uploaded_file( $_FILES['file']['tmp_name'], $path ) ) {
			echo "The file " . basename( $_FILES['file']['name'] ) .
			     " has been uploaded";
			$reference->file = $path;
			$reference->save();
		} else {
			echo "There was an error uploading the file, please try again!";
		}
	} else {
		echo "File is empty";
		print_r( $_FILES );
	}

	if ( Reference::exists( $reference->id ) ) {
		$flag    = true;
		$message = 'Reference Added : ';
		GhLogger::writeLog( $_SESSION['email'] . " Added a new journal entry. Ref. Number : " . $reference->id );
	} else {

		$message = 'Failed to add Reference';
	}

} else {

	$message = 'Reference already exists. Please reload the page';
}


if ( $flag ) {

	foreach ( $journal_entries as $journal_entry ) {

		parse_str( $journal_entry, $output );


		$j               = new Journal;
		$j->reference_id = $reference->id;
		$j->account_name = $output['type'];
		$j->status       = 'PENDING';

		if ( isset( $output['credit'] ) && is_numeric( $output['credit'] ) ) {

			$j->credit = $output['credit'];
			$j->debit  = null;

		} else if ( isset( $output['debit'] ) && is_numeric( $output['debit'] ) ) {

			$j->debit  = $output['debit'];
			$j->credit = null;

		} else {

			continue;
		}

		$j->save();

		if ( $j->id ) {
			$message .= $j->id . ' ';
		}

	}


}

echo json_encode( [ 'message' => $message ] );

/*
$ref_id = Journal::nextReferenceNumber();


$journal_entries = json_decode( file_get_contents( 'php://input' ), true );

$vars = [];
$flag = false;
foreach ( $journal_entries as $journal_entry ) {

	parse_str( $journal_entry, $output );

//	echo json_encode( $journal_entry );
//	break;

//	echo $output['type'];
//	echo $output['credit'];

	$j                 = new Journal;
	$j->reference_id   = $ref_id;
	$j->account_number = $output['type'];
	$j->status         = 'PENDING';


	if ( isset( $output['credit'] ) && is_numeric( $output['credit'] ) ) {

		$j->credit = $output['credit'];
		$j->debit  = 0;

	} else if ( isset( $output['debit'] ) && is_numeric( $output['debit'] ) ) {

		$j->debit  = $output['debit'];
		$j->credit = 0;

	} else {

		continue;
	}


	$j->save();
	$flag = true;

}

if ( $flag ) {
	echo json_encode( "Journal entry added. Status : PENDING" );
} else {
	echo json_encode( "Journal entry was not added. Probably empty" );
}
//print_r( $_POST );
*/
?>
