<?php

class Reference extends SimpleOrm {


	public static function nextReferenceNumber() {

		$account = Reference::sql( "SELECT id FROM :TABLE ORDER BY id DESC LIMIT 1", SimpleOrm::FETCH_ONE );

		if ( $account ) {
			return $account->id + 1;
		}

		return 1;
	}

	public static function exists( $pk ) {

		$account = Reference::sql( "SELECT * FROM :TABLE  WHERE id=$pk ORDER BY id DESC LIMIT 1", SimpleOrm::FETCH_ONE );

		if ( $account ) {
			return true;
		}

		return false;
	}

	public static function updateReference( $reference_id, $status, $reason ) {

		$records         = Reference::sql( "SELECT * FROM :TABLE WHERE id='$reference_id'", SimpleOrm::FETCH_ONE );
		$records->status = $status;
		$records->reason = $reason;

		$records->save();


	}
}