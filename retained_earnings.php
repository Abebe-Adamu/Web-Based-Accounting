<?php require_once 'templates/header.php'; ?>
<?php

try {
    $net_income = Account::getNetIncome();
    $retained_earning = Account::getRetainedEarnings();
    $dividends = Account::getDividends();

    $end_retained_earnings = $retained_earning + $net_income - $dividends;

} catch (Exception $e) {
    $net_income = 0;
    $retained_earning = 0;
    $dividends = 0;

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
                    <h5> Statement of Retained Earnings</h5>
                    <h6>For the Year Ended April 30,2010</h6>

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
                            <strong class="card-title"></strong>
                        </div>
                        <div class="card-body container-fluid">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered "
                                   style="table-layout: fixed;">
                                <thead>

                                <tr>
                                    <td>Beginner Retained Earnings</td>
                                    <td align='right'><?= '$' . number_format($retained_earning, 2, '.', ',') ?></td>
                                </tr>
                                <tr>
                                    <td>Net Income</td>
                                    <td align='right'><?= '$' . number_format($net_income, 2, '.', ',') ?></td>
                                </tr>
                                <tr>
                                    <td>Dividends</td>
                                    <td align='right'><?= '$' . number_format($dividends, 2, '.', ',') ?></td>
                                </tr>
                                <tr>
                                    <td>End Retained Earnings</td>
                                    <td align='right' class="">
                                        <?php echo "<span class='doubleUnderline'>"; ?>
                                        <?= '$' . number_format($retained_earning + $net_income - $dividends, 2, '.', ',') ?>
                                        <?php echo "</span>"; ?>
                                    </td>
                                </tr>

                                </thead>
                                <tbody>
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
