<?php


class Account extends SimpleOrm
{


    public static function exists($number)
    {

        $account = Account::sql("SELECT * FROM :TABLE  WHERE account_number='$number' ORDER BY id DESC LIMIT 1", SimpleOrm::FETCH_ONE);

        if ($account) {
            return true;
        }

        return false;
    }

    public static function nextAccountNumber()
    {

        $account = Account::sql("SELECT id,account_number FROM :TABLE ORDER BY id DESC LIMIT 1", SimpleOrm::FETCH_ONE);

        return $account->account_number + 1;
    }


    public static function getJournalsForAccounts()
    {

        $journals = [];

        $accounts = Account::all();

        $credit_sum = 0;
        $debit_sum = 0;

        foreach ($accounts as $account) {

//			$j = Journal::retrieveByAccountName( $account->name, SimpleOrm::FETCH_MANY );
            $j = Journal::sql("SELECT * FROM :TABLE WHERE `account_name`='" . $account->name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_MANY);

            $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account->name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

            $balance = $b->debit - $b->credit;

            $journals[$account->name] = [
                'account' => $account,
                'journals' => $j,
                'balance' => $balance,
                'date' => '',
                'credit' => $b->credit,
                'debit' => $b->debit,
            ];
        }

        return $journals;
    }

    public static function getJournalsForRevenuesAndIncome()
    {

        $journals = self::getJournalsForAccounts();

        $results = [

            'revenue' => [],
            'expense' => []
        ];

        foreach ($journals as $account_name => $journal) {

            if (self::endsWith(strtolower($account_name), 'revenue') && $journal['account']->type == 'revenue') {

                $results['revenue'][] = [
                    'account' => $journals[$account_name]['account'],
                    'balance' => $journals[$account_name]['balance']

                ];

            } else if (self::endsWith(strtolower($account_name), 'expense')) {
                $results['expense'][] = [
                    'account' => $journals[$account_name]['account'],
                    'balance' => $journals[$account_name]['balance']
                ];
            }

        }

        return $results;

    }

    public static function accountNumberByName($name)
    {

        $j = Account::retrieveByName($name, SimpleOrm::FETCH_ONE);
        if ($j) {
            return $j->account_number;
        }

        return 0;

    }

    public static function getNetIncome()
    {

        $accounts = (Account::getJournalsForRevenuesAndIncome());
        $revenues = $accounts['revenue'];
        $expenses = $accounts['expense'];

        $debit_sum = 0;
        $credit_sum = 0;

        foreach ($revenues as $revenue_account) {
            if ($revenue_account['balance'] < 0) {
                $debit_sum += -1 * $revenue_account['balance'];
            }
        }

        foreach ($expenses as $revenue_account) {
            if ($revenue_account['balance'] > 0) {
                $credit_sum += $revenue_account['balance'];
            }
        }

        return $debit_sum - $credit_sum;

    }

    public static function getRetainedEarnings()
    {
        $account_name = 'Retained Earnings';

        $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account_name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

        $balance = $b->debit - $b->credit;

        return $balance;


    }

    public static function getDividends()
    {
        $account_name = 'Dividends Declared';

        $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account_name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

        $balance = $b->debit - $b->credit;

        return $balance;


    }

    public static function getSupplies()
    {
        $account_name = 'Supplies';

        $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account_name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

        $balance = $b->debit - $b->credit;

        return $balance;


    }

    public static function getUnEarnedRevenues()
    {
        $account_name = 'Unearned Revenue';

        $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account_name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

        $balance = $b->debit - $b->credit;

        return abs($balance);


    }

    public static function getContributedCapital()
    {
        $account_name = 'Contributed Capital';

        $b = Journal::sql("SELECT sum(credit) AS credit, sum(debit) AS debit FROM :TABLE WHERE `account_name`='" . $account_name . "' AND `status`='APPROVED'", SimpleOrm::FETCH_ONE);

        $balance = $b->debit - $b->credit;

        return abs($balance);


    }

    public static function getCurrentAssets()
    {


        $journals = self::getJournalsForAccounts();
        $results = [];

        foreach ($journals as $account_name => $journal) {


//			print_r( $journal['account']);
            if ($journal['account']->sub_type == 'current asset') {
                $results[] = [
                    'account' => $journal['account'],
                    'credit' => $journal['credit'],
                    'debit' => $journal['debit'],
                    'balance' => $journal['balance']
                ];
            }

        }

        return $results;


    }

    public static function getCurrentAssetsSum()
    {


        $journals = self::getJournalsForAccounts();
        $total = 0;

        foreach ($journals as $account_name => $journal) {


//			print_r( $journal['account']);
            if ($journal['account']->sub_type == 'current asset') {

                $total += abs($journal['balance']);
//				$results[] = [
//					'account' => $journal['account'],
//					'credit'  => $journal['credit'],
//					'debit'   => $journal['debit'],
//					'balance' => $journal['balance']
//				];
            }

        }

        return $total;


    }

    public static function getTotalRevenue()
    {


        $journals = self::getJournalsForRevenuesAndIncome()['revenue'];
        $total = 0;

        foreach ($journals as $account_name => $journal) {

            $total += abs($journal['balance']);

        }

        return $total;


    }


    public static function getEquities()
    {


        $journals = self::getJournalsForAccounts();
        $results = [];

        foreach ($journals as $account_name => $journal) {


//			print_r( $journal['account']);
            if ($journal['account']->type == 'equity') {
                $results[] = [
                    'account' => $journal['account'],
                    'credit' => $journal['credit'],
                    'debit' => $journal['debit'],
                    'balance' => $journal['balance']
                ];
            }

        }

        return $results;


    }

    public static function getEquipments()
    {


        $journals = self::getJournalsForAccounts();
        $results = [];

        foreach ($journals as $account_name => $journal) {


//			print_r( $journal['account']);
            if ($journal['account']->sub_type == 'property plant and equipment') {
                $results[] = [
                    'account' => $journal['account'],
                    'credit' => $journal['credit'],
                    'debit' => $journal['debit'],
                    'balance' => $journal['balance']
                ];
            }

        }

        return $results;


    }

    public static function getEquipmentsSum()
    {


        $journals = self::getJournalsForAccounts();
        $total = 0;

        foreach ($journals as $account_name => $journal) {


            if ($journal['account']->sub_type == 'property plant and equipment') {
                $total += $journal['balance'];
            }

        }

        return $total;


    }

    public static function getCurrentLiabilities()
    {


        $journals = self::getJournalsForAccounts();
        $results = [];

        foreach ($journals as $account_name => $journal) {

            if ($journal['account']->type == 'liability' && $journal['account']->sub_type == 'current liability') {
                $results[] = [
                    'account' => $journal['account'],
                    'credit' => $journal['credit'],
                    'debit' => $journal['debit'],
                    'balance' => abs($journal['balance'])
                ];
            }

        }

        return $results;


    }

    public static function getLiabilities()
    {


        $journals = self::getJournalsForAccounts();
        $results = [];

        foreach ($journals as $account_name => $journal) {

            if ($journal['account']->type == 'liability') {
                $results[] = [
                    'account' => $journal['account'],
                    'credit' => $journal['credit'],
                    'debit' => $journal['debit'],
                    'balance' => abs($journal['balance'])
                ];
            }

        }

        return $results;


    }

    public static function getCurrentLiabilitiesSum()
    {


        $journals = self::getJournalsForAccounts();
        $total = 0;

        foreach ($journals as $account_name => $journal) {

            if ($journal['account']->type == 'liability' && $journal['account']->sub_type == 'current liability') {
                $total += abs($journal['balance']);
            }

        }
        return $total;


    }

    public static function getLiabilitiesSum()
    {


        $journals = self::getLiabilities();
        $total = 0;

        foreach ($journals as $account_name => $journal) {

            if ($journal['account']->type == 'liability') {
                $total += abs($journal['balance']);
            }

        }
        return $total;


    }


    static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }
}