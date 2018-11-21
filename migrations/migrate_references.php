<?php


$accounts = [
	[
		'id'          => '1',
		'date'        => '04/04/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '2',
		'date'        => '04/04/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '3',
		'date'        => '04/04/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '4',
		'date'        => '04/06/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '5',
		'date'        => '04/07/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '6',
		'date'        => '04/08/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '7',
		'date'        => '04/11/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '8',
		'date'        => '04/12/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '9',
		'date'        => '04/15/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '10',
		'date'        => '04/15/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '11',
		'date'        => '04/15/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '12',
		'date'        => '04/18/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '13',
		'date'        => '04/22/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],

	[
		'id'          => '14',
		'date'        => '04/22/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '15',
		'date'        => '04/25/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '16',
		'date'        => '04/27/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '17',
		'date'        => '04/28/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '18',
		'date'        => '04/29/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '19',
		'date'        => '04/29/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '20',
		'date'        => '04/29/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '21',
		'date'        => '04/29/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],



	[
		'id'          => '22',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '23',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '24',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '25',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '26',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],
	[
		'id'          => '27',
		'date'        => '04/30/2002',
		'file'        => '',
		'description' => '',
		'status'      => 'APPROVED',
		'reason'      => '',
	],


];

foreach ( $accounts as $account ) {
	$sql = "INSERT INTO reference
			(`id`, `date`, `file`, `description`, `status`, `reason`)
			VALUES
			(
			'" . $account['id'] . "',
			'" . $account['date'] . "',
			'" . $account['file'] . "',
			'" . $account['description'] . "',
			'" . $account['status'] . "',
			'" . $account['reason'] . "'
			)
		";
	if ( $db->query( $sql ) ) {
		echo "Reference " . $account['id'] . " has been added successfully<br>";
	} else {
		echo "failed to add account " . $account['id'] . " to the Reference table<br>";
		echo $db->error;
	}
}


?>
