<?php require_once 'templates/header.php'; ?>
<?php

try {
//	$journals = Journal::all();


    $journals = (Account::getJournalsForAccounts());

//	echo '<pre>';
//	print_r( $journals['Cash']['balance'] );
//	echo '</pre>';
////
//	die();

} catch (Exception $e) {
    $journals = [];
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
                    <h1>Ledgers</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">

            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">


                    <?php

                    foreach ($journals as $reference_id => $journal) {

                        $options = $journal['account'];


                        $table_id = 'bootstrap-data-table';// . $options->id;

                        echo '<div class="card" name="' . Account::accountNumberByName($reference_id) . '">';

                        echo '<div class="card-header">';


                        echo "<strong class='card-title'>Account Name : $options->name</strong><br>";
                        echo '<div class="card-body">';


                        echo '<table id="' . $table_id . '" class="table table-striped table-bordered data-table">';

                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Date</th>";
//						echo "<th>Account Name</th>";
                        echo "<th>Debit</th>";
                        echo "<th>Credit</th>";
//						echo "<th>Status</th>";
                        echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";

                        foreach ($journal['journals'] as $j) {
                            echo "<tr class='$j->status'>";
                            echo "<td>" . Reference::retrieveByPK(intval($j->reference_id))->date . "</td>";
//							echo "<td>$j->account_name</td>";


                            if ($j->debit == 0) {
                                echo "<td></td>";
                            } else {
                                echo "<td align='right'>" . '$' . number_format($j->debit, 2, '.', ',') . "</td>";
                            }


                            if ($j->credit == 0) {
                                echo "<td></td>";
                            } else {
                                echo "<td align='right'>" . '$' . number_format($j->credit, 2, '.', ',') . "</td>";

                            }

//							echo "<td>$j->status</td>";
                            echo "</tr>";
                        }


                        echo "</tbody>";

                        echo "<tr class='$j->status'>";

                        echo "<td><strong>End Balance </strong> </td>";
                        if ($journal['balance'] > 0) {
                            echo "<td>";
                            echo '$' . number_format($journal['balance'], 2, '.', ',');
                            echo "</td>";
                            echo "<td></td>";

                        } else {

                            echo "<td></td>";
                            echo "<td>";
                            echo '$' . number_format(-1 * $journal['balance'], 2, '.', ',');
                            echo "</td>";
                        }
                        echo "</tr>";
                        echo '</table>';


                        echo '</div>';
                        echo '</div>';
                        echo '</div>';


                    }

                    ?>


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

        $('.data-table').each(function () {
            $(this).DataTable();
        });


    });

    function update_journal(id, status) {


        var url = "auth/journal_update.php"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: ("reference_id=" + id + "&status=" + status),
            success: function (d) {
                console.log(JSON.stringify(d));
                alert("Journal Updated ");
                location.reload();

            },
            error: function (d, e) {
                // alert(e);
                alert("Journal Update failed ");
                console.log(JSON.stringify(d));
            }

        });


    }


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
