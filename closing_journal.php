<?php require_once 'templates/header.php'; ?>
<?php

try {
    $accounts = (Account::getJournalsForRevenuesAndIncome());
    $revenues = $accounts['revenue'];
    $expenses = $accounts['expense'];

    $net_income = Account::getNetIncome();
    $retained_earning = Account::getRetainedEarnings();
    $dividends = Account::getDividends();

    $end_retained_earnings = $retained_earning + $net_income - $dividends;

//	echo '<pre>';
//	print_r( $accounts );
//	echo '<pre>';
//	die();
} catch (Exception $e) {
    $accounts = [];
    $revenues = [];
    $expenses = [];
    echo '00000';
}
?>
<body>
<!-- Left Panel -->
<?php require_once 'templates/sidebar.php'; ?>
<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php require_once 'templates/nav_header.php'; ?>
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Closing Journal Entries</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Service Revenue</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered "
                                   style="table-layout: fixed;">
                                <thead>
                                <tr>


                                    <th>Name</th>
                                    <th>Debit</th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php


                                $debit_sum = 0;

                                foreach ($revenues

                                         as $revenue_account) {


                                    $id = $revenue_account['account']->id;
                                    $form_id = "form_" . $id;
                                    echo "<form class='journal' id='$form_id'></form>";
                                    echo "<input form='$form_id' type='hidden' name='account_name' value='" . $revenue_account['account']->name . "'>";
                                    echo "<input form='$form_id' type='hidden' name='amount' value='" . abs($revenue_account['balance']) . "'>";
                                    echo "<input form='$form_id' type='hidden' name='type' value='debit'>";

                                    echo '<tr>';
                                    echo '<td >' . $revenue_account['account']->name . '</td>';

                                    if ($revenue_account['balance'] <= 0) {
//										echo '<td ></td>';
                                        echo '<td align=\'right\'>' . '$' . number_format(abs($revenue_account['balance']), 2, '.', ',') . '</td>';
                                        $debit_sum += -1 * $revenue_account['balance'];

                                    } else {
//                                        print_r($revenue_account['balance']);
                                    }

                                    echo '</tr>';


                                }

                                echo "
                               </tbody>";


                                ?>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-body container-fluid">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered "
                                   style="table-layout: fixed;">
                                <thead>
                                <tr>


                                    <th>Name</th>
                                    <th>Credit</th>


                                </tr>
                                </thead>
                                <tbody>


                                <?php


                                $credit_sum = 0;


                                foreach ($expenses as $revenue_account) {


                                    echo '<tr>';

                                    $id = $revenue_account['account']->id;
                                    $form_id = "form_" . $id;
                                    echo "<form class='journal' id='$form_id'></form>";
                                    echo "<input form='$form_id' type='hidden' name='account_name' value='" . $revenue_account['account']->name . "'>";
                                    echo "<input form='$form_id' type='hidden' name='amount' value='" . $revenue_account['balance'] . "'>";
                                    echo "<input form='$form_id' type='hidden' name='type' value='credit'>";

                                    echo '<td >' . $revenue_account['account']->name . '</td>';

                                    if ($revenue_account['balance'] >= 0) {

                                        echo '<td align=\'right\'>' . '$' . number_format($revenue_account['balance'], 2, '.', ',') . '</div></td>';
//										echo '<td ></td>';


                                        $credit_sum += $revenue_account['balance'];
                                    } else {
//                                        print_r($revenue_account['balance']);
                                    }

                                    echo '</tr>';


                                }

                                echo " <tr>";
                                echo " <td>Retained Earnings </td > ";
                                echo "<td align = 'right' > " . '$' . number_format($end_retained_earnings, 2, '.', ',') . "</td> ";


                                echo "</tr>";


                                if ($_SESSION['group'] == 'manager') {
                                    echo "<td><button  id='close_journal' name='close' class='btn btn-info' href='auth/close_journal.php' form='$form_id'> Close Journal</button></td>";
                                }

                                echo "</tbody> ";


                                ?>

                            </table>
                        </div>
                    </div>


                </div>


            </div>


        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


<script type="text/javascript">

    $('#close_journal').on('click', function (e) {

        console.log($(this).serialize());

        var url = "auth/close_journal.php"; // the script where you handle the form input.


        var data = [];
        $('.journal').each(function () {

            data.push([$(this).serialize()]);

        });

        console.log(data);


        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'json',
            success: function (d) {
                console.log(d);
                alert(d);
                window.location = 'closing_journal.php';
            },
            error: function (d, e) {
                // alert(e);
                console.log(d.responseText);
                // console.log(e);
            }

        });

        e.preventDefault();


    });
</script>


</body>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Sufee Admin - HTML5 Admin Template </title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel = "stylesheet" href = "assets/css/bootstrap-select.less" > -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type = "text/javascript" src = "https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js" ></script > -->

</head>
</html >
