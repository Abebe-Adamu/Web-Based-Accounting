<?php require_once 'templates/header.php'; ?>
<?php

try {
	$accounts = Account::all();
} catch ( Exception $e ) {
	$accounts = [];
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
                    <h1>Chart of Accounts</h1>
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
                            <strong class="card-title">Accounts</strong>
                        </div>
                        <div class="card-body container-fluid">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered "
                                   style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Account Number</th>
                                    <th>Name</th>
                                    <th>Normal Side</th>
                                    <th>Type</th>
                                    <th>Initial Balance</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Modify</th>
                                </tr>
                                </thead>
                                <tbody>

								<?php

								if ( $_SESSION['group'] == 'admin' || $_SESSION['group'] == 'manager' ) {
									$class = 'input';
								} else {
									$class = '';
								}
								foreach ( $accounts as $account ) {
									echo '<tr><div class="form">';
									echo '<td ><div class="inp-id">' . $account->id . '</div></td>';
									echo '<td ><div class="inp-number"><a href="ledgers.php#' . $account->account_number . '"> ' . $account->account_number . '</a></div></td>';
									echo '<td ><div class="' . $class . ' inp-name">' . $account->name . '</div></td >';
									echo '<td ><div class="' . $class . '  inp-normal_side">' . $account->normal_side . '</div></td >';
									echo '<td ><div class="inp-type">' . $account->type . '</div></td >';
									echo '<td ><div class="' . $class . '  inp-initial_balance">' . $account->initial_balance . '</div></td >';
									echo '<td ><div class="' . $class . '  inp-comments">' . $account->comments . '</div></td >';
									echo '<td ><div class="' . $class . '  inp-active">' . $account->active . '</div></td >';
//									echo '<td ><input class="non_editable" name="normal_side" type="text" value="' . $account->normal_side . '"></td>';
//									echo '<td ><input class="non_editable" name="type" type="text" value="' . $account->type . '"></td>';
//									echo '<td ><input class="non_editable" name="initial_balance" type="text" value="' . $account->initial_balance . '"></td>';
//									echo '<td ><input class="non_editable" name="comments" type="text" value="' . $account->comments . '"></td>';
//									echo '<td ><input class="non_editable" name="active" type="text" value="' . $account->active . '"></td>';
									echo '<td ><button class="btn btn-info btn-lg btn-edit">EDIT</button><button class="btn btn-success btn-lg hide">SAVE</button></td>';
									echo '</form></tr>';

								}
								?>
                                </tbody>
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


<script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table-export').DataTable();


        $('.btn-edit').on('click', function (e) {

            if ($(this).text() === 'EDIT') {

                alert('CLick on an item to edit it');

                $(this).text("Save");

                var form = $(this).parent().parent().find('.input');

                form.each(function () {

                    $(this).attr('contenteditable', 'true');
                });

            } else {

                var id = $(this).parent().parent().find('.inp-id').text();
                var account_number = $(this).parent().parent().find('.inp-number').text();
                var name = $(this).parent().parent().find('.inp-name').text();
                var normal_side = $(this).parent().parent().find('.inp-normal_side').text();
                // var type = $(this).parent().parent().find('.inp-type').text();
                var initial_balance = $(this).parent().parent().find('.inp-initial_balance').text();
                var active = $(this).parent().parent().find('.inp-active').text();
                var comments = $(this).parent().parent().find('.inp-comments').text();


                var data = 'id=' + id + '&account_number=' + account_number + '&name=' + name + '&normal_side='
                    + normal_side + '&initial_balance=' + initial_balance + '&comments=' + comments + '&active=' + active;

                var url = "auth/account.php"; // the script where you handle the form input.

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function (d) {

                        alert(d.message);
                    },
                    error: function (d, e) {
                        // alert(e);
                        alert(JSON.stringify(d));
                        console.log(data);
                    }

                });

            }


        });

    })
    ;


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
