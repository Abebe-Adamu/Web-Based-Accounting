<?php

$accounts = [
	[
		'account_number'  => '101',
		'name'            => 'Cash',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'current asset',
	],

	[
		'account_number'  => '102',
		'name'            => 'Contributed Capital',
		'normal_side'     => 'L',
		'type'            => 'equity',
		'initial_balance' => '0',
		'sub_type'        => '',
	],

	[
		'account_number'  => '103',
		'name'            => 'Unearned Revenue',
		'normal_side'     => 'L',
		'type'            => 'liability',
		'initial_balance' => '0',
		'sub_type'        => '',
	],


	[
		'account_number'  => '108',
		'name'            => 'Retained Earnings',
		'normal_side'     => 'L',
		'type'            => 'equity',
		'initial_balance' => '0',
		'sub_type'        => '',
	],


	[
		'account_number'  => '109',
		'name'            => 'Dividends Declared',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => '',
	],


	[
		'account_number'  => '22',
		'name'            => 'Accounts Receivable',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'current asset',
	],
	[
		'account_number'  => '141',
		'name'            => 'Supplies',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'current asset',
	],
	[
		'account_number'  => '181',
		'name'            => 'Office Equipments',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'property plant and equipment',
	],
	[
		'account_number'  => '201',
		'name'            => 'Prepaid Rent',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'current asset',
	],
	[
		'account_number'  => '204',
		'name'            => 'Prepaid Insurance',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'current asset',
	],
	[
		'account_number'  => '217',
		'name'            => 'Advertising Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '221',
		'name'            => 'Accounts Payable',
		'normal_side'     => 'L',
		'type'            => 'liability',
		'initial_balance' => '0',
		'sub_type'        => 'current liability',
	],
	[
		'account_number'  => '504',
		'name'            => 'Salaries Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '505',
		'name'            => 'Service Revenue',
		'normal_side'     => 'L',
		'type'            => 'revenue',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '506',
		'name'            => 'Telephones Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '507',
		'name'            => 'Utilities Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '508',
		'name'            => 'Insurance Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '509',
		'name'            => 'Telephones Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],

	[
		'account_number'  => '510',
		'name'            => 'Supplies Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
	[
		'account_number'  => '511',
		'name'            => 'Depreciation Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],

	[
		'account_number'  => '512',
		'name'            => 'Accumulated Depreciation',
		'normal_side'     => 'L',
		'type'            => 'asset',
		'initial_balance' => '0',
		'sub_type'        => 'property plant and equipment',
	],
	[
		'account_number'  => '513',
		'name'            => 'Salaries Payable',
		'normal_side'     => 'L',
		'type'            => 'liability',
		'initial_balance' => '0',
		'sub_type'        => 'current liability',
	],

	[
		'account_number'  => '514',
		'name'            => 'Rent Expense',
		'normal_side'     => 'L',
		'type'            => 'expenses',
		'initial_balance' => '0',
		'sub_type'        => '',
	],
];

foreach ( $accounts as $account ) {
	$sql = "INSERT INTO account
			(`account_number`, `name`, `normal_side`, `type`, `sub_type`, `initial_balance`)
			VALUES
			(
			'" . $account['account_number'] . "',
			'" . $account['name'] . "',
			'" . $account['normal_side'] . "',
			'" . $account['type'] . "',
			'" . $account['sub_type'] . "',
			'" . $account['initial_balance'] . "'
			)
		";
	if ( $db->query( $sql ) ) {
		echo "account " . $account['account_number'] . " has been added successfully<br>";
	} else {
		echo "failed to add account " . $account['account_number'] . " to the user table<br>";
		echo $db->error;
	}
}


?>
