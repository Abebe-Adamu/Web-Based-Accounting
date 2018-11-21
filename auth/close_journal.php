<?php

require_once '../config/database.php';
require_once '../models/Journal.php';
require_once '../models/Reference.php';
require_once '../lib/GhLogger.php';


$journals = json_decode(file_get_contents('php://input'), true);


//print_r(date('m/d/Y', time()));

//die();

$reference_id = Reference::nextReferenceNumber();


$reference = new Reference;
$reference->id = $reference_id;
$reference->date = $date = date('m/d/Y', time());
$reference->description = 'Journal Entry Closed';
$reference->status = 'APPROVED';

$reference->save();

foreach ($journals as $journal) {

//    print_r($journal);
    parse_str($journal[0], $output);
//    print_r($output);
//    continue;

    $j = new Journal;
    $j->reference_id = $reference->id;
    $j->account_name = $output['account_name'];
    $j->status = 'APPROVED';

    if ($output['type'] == 'credit') {

        $j->credit = $output['amount'];
        $j->debit = null;

    } else {

        $j->debit = $output['amount'];
        $j->credit = null;

    }

    $j->save();

}

echo json_encode('Journal is successfully closed.');