<?php


class Journal extends SimpleOrm {


	public static function getJournalForTable() {

		$journals = [];

		$references = Reference::all();

		foreach ( $references as $reference ) {

			$j = Journal::retrieveByReferenceId( $reference->id, SimpleOrm::FETCH_MANY );

			$journals[ $reference->id ] = [
				'reference' => $reference,
				'journals'  => $j
			];
		}

		return $journals;
	}


	public static function updateJournals( $reference_id, $status ) {

		$records = Journal::sql( "SELECT * FROM :TABLE WHERE reference_id='$reference_id'", SimpleOrm::FETCH_MANY );
		foreach ( $records as $record ) {

			$record->status = $status;
			$record->save();

		}


	}




}