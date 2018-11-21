<?php require_once 'templates/header.php'; ?>
<?php

try {
    $accounts = Account::getCurrentAssets();
    $equipments = Account::getEquipments();
    $equities = Account::getEquities();
    $current_liabilities = Account::getCurrentLiabilities();
    $unearned_revenues = Account::getUnEarnedRevenues();

    $net_income = Account::getNetIncome();
    $retained_earning = Account::getRetainedEarnings();
    $dividends = Account::getDividends();
    $end_retained = $retained_earning + $net_income - $dividends;

    $contributed_capital = Account::getContributedCapital();


//	echo '<pre>';
//	foreach ( $accounts as $account ) {
//		print_r( $account['account']->name );
//		echo '<br>';
//		print_r( $account['credit'] );
//		echo '<br>';
//		print_r( $account['debit'] );
//		echo '<br>';
//		print_r( $account['balance'] );
//		echo '<br>';
//
//	}
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

                    <h4>Addams & Family Inc.</h4>
                    <h5>Balance Sheet</h5>
                    <h6>At April 30,2010</h6>
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
                            <strong class="card-title">Assets</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <strong class="card-title">Current Assets</strong>
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
                                $current_asset_sum = 0;
                                foreach ($accounts as $revenue_account) {
                                    echo '<tr>';
                                    echo '<td>' . $revenue_account['account']->name . '</td>';
                                    echo '<td align=\'right\'>' . '$' . number_format($revenue_account['balance'], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                    $current_asset_sum += $revenue_account['balance'];
                                }
                                echo "</tbody>";
                                echo "<td><strong>Total Current Assets</strong> </td>";
                                echo "<td align='right'>" . '$' . number_format($current_asset_sum, 2, '.', ',') . "</td>";
                                echo "</tr>";
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Expenses</strong>
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
                                $equipments_sum = 0;
                                foreach ($equipments as $revenue_account) {
                                    echo '<tr>';
                                    echo '<td>' . $revenue_account['account']->name . '</td>';
                                    echo '<td align=\'right\'>' . '$' . number_format($revenue_account['balance'], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                    $equipments_sum += $revenue_account['balance'];
                                }
                                echo "</tbody>";
                                echo "<td><strong>Total Expenses</strong> </td>";
                                echo "<td align='right'>" . '$' . number_format($equipments_sum, 2, '.', ',') . "</td>";
                                echo "</tr>";
                                ?>
                            </table>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Total Assets</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <span class="doubleUnderline">
                            <?= '$' . number_format($current_asset_sum + $equipments_sum, 2, '.', ',') ?>
                                </span>
                        </div>
                    </div>


                </div>


            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Liabilities & Stakeholders Equity</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <strong class="card-title">Liabilities</strong>
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
                                $current_liabilities_sum = 0;
                                foreach ($current_liabilities as $revenue_account) {
                                    echo '<tr>';
                                    echo '<td>' . $revenue_account['account']->name . '</td>';
                                    echo '<td align=\'right\'>' . '$' . number_format($revenue_account['balance'], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                    $current_liabilities_sum += $revenue_account['balance'];
                                }
                                echo "</tbody>";
                                echo "<td><strong>Total Liabilities</strong> </td>";
                                echo "<td>" . '$' . number_format($current_liabilities_sum, 2, '.', ',') . "</td>";
                                echo "</tr>";
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 ">


                    <div class="card">

                        <div class="card-header">
                            <strong class="card-title"></strong>
                        </div>
                        <div class="card-body container-fluid">
                            <table class="table table-striped table-bordered ">
                                <tr>
                                    <td>Total Current Liabilities</td>
                                    <td align='right'><?= '$' . number_format($current_liabilities_sum, 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td>Unearned Revenues</td>
                                    <td align='right'><?= '$' . number_format($unearned_revenues, 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Liabilities</td>
                                    <?php $total_liabilities = $current_liabilities_sum + $unearned_revenues; ?>
                                    <td align='right'><?= '$' . number_format($total_liabilities, 2, '.', ','); ?></td>
                                </tr>
                                <tr></tr>
                            </table>

                        </div>
                    </div>


                </div>


            </div>


            <div class="row">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Expenses</strong>
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
                                $equipments_sum = 0;
                                foreach ($equipments as $revenue_account) {
                                    echo '<tr>';
                                    echo '<td>' . $revenue_account['account']->name . '</td>';
                                    echo '<td align=\'right\'>' . '$' . number_format($revenue_account['balance'], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                    $equipments_sum += $revenue_account['balance'];
                                }
                                echo "</tbody>";
                                echo "<td><strong>Total Expenses</strong> </td>";
                                echo "<td align='right'>" . '$' . number_format($equipments_sum, 2, '.', ',') . "</td>";
                                echo "</tr>";
                                ?>
                            </table>
                        </div>
                    </div>

                    <div class="card">

                        <div class="card-header">
                            <strong class="card-title">Stockholders Equity</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <table class="table table-striped table-bordered ">
                                <tr>
                                    <td>Contributed Capital</td>
                                    <td align='right'><?= '$' . number_format($contributed_capital, 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td>Retained Earnings</td>
                                    <td align='right'><?= '$' . number_format($end_retained, 2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Stockholders Equity</td>
                                    <?php $total_equity = $contributed_capital + $end_retained; ?>
                                    <td align='right'><?= '$' . number_format($total_equity, 2, '.', ','); ?></td>
                                </tr>
                                <tr></tr>
                            </table>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Total Liabilities & Stakeholders Equity</strong>
                        </div>
                        <div class="card-body container-fluid ">
                            <span class="doubleUnderline">
                            <?= '$' . number_format($total_liabilities + $total_equity, 2, '.', ',')
                            ?>
                                </span>
                        </div>
                    </div>
                </div>


            </div>


        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


<script type="text/javascript">

</script>


</body>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
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
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
</html>
