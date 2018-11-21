<?php require_once 'templates/header.php'; ?>
<?php try {
    $accounts = Account::all();

    $menu = '';
    foreach ($accounts as $account) {

        $menu .= '<option value="' . $account->name . '">' . $account->name . '-' . $account->account_number . '</option>';
    }


} catch (Exception $e) {
    $accounts = [];
} ?>
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
                    <h1>Journal</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">

            <div class="row">

                <div class="col-lg-12 align-content-lg-center align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <strong>Options</strong>
                        </div>
                        <div class="card-body card-block">
                            <form id="options-form" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Reference
                                            Number</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="form-control-static"><?php echo Reference::nextReferenceNumber(); ?></p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input"
                                                                     class=" form-control-label">Date</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="hidden" name="reference_number"
                                               value="<?php echo Reference::nextReferenceNumber(); ?>">
                                        <input type="date" id="text-input" name="date"
                                               placeholder="01/01/2000" class="form-control">

                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>

                </div>

            </div>


            <div class="row">

                <div class="col-lg-12 align-content-lg-center align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <strong>Add Journal</strong>
                        </div>
                        <div class="card-body card-block" id="form-journal">


                            <table class="form-table" id="customFields">
                                <tr valign="top">

                                    <!--                                        <th scope="row"><label for="customFieldName">Custom Field</label></th>-->
                                    <td>
                                        <form class="form-journal">
                                            <div class="col-3 col-md-3 form-group">
                                                <select name="type" id="select" class="form-control">
                                                    <?php echo $menu; ?>
                                                </select>
                                            </div>
                                            <div class="col-3 col-md-3 form-group">
                                                <input type="text" class="form-control debit-box"
                                                       id="customFieldValue"
                                                       name="debit" value="" placeholder="Debit Amount"/>
                                            </div>
                                            <div class="col-3 col-md-3 form-group">

                                                <input class="form-control credit-box" type="text"
                                                       id="customFieldName"
                                                       name="credit" value="" placeholder="Credit Amount"/>

                                            </div>
                                            <a href="javascript:void(0);" class="btn addCF btn-success">Add</a>
                                        </form>
                                    </td>

                                </tr>

                            </table>


                        </div>

                    </div>

                </div>


            </div>
            <div class="row">

                <div class="col-lg-12 align-content-lg-center align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <strong>Extras</strong>
                        </div>
                        <div class="card-body card-block">
                            <form id="journal-form" class="form-horizontal" enctype="multipart/form-data">


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input"
                                                                     class=" form-control-label">File</label></div>
                                    <div class="col-12 col-md-9"><input type="file" id="file-input" name="file_input"
                                                                        class="form-control-file"></div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label>
                                    </div>
                                    <div class="col-12 col-md-9"><textarea name="description" id="textarea-input"
                                                                           rows="9" placeholder="Description..."
                                                                           class="form-control"></textarea></div>
                                </div>

                                <button type="submit" value="submit" id="form-submit" class="btn btn-primary btn-sm">
                                    Submit
                                </button>
                                <button value="cancel" id="form-cancel" class="btn btn-danger btn-sm">
                                    Cancel
                                </button>

                            </form>
                        </div>

                    </div>

                </div>

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script !src="">


    $(document).ready(function () {
        $(".addCF").click(function () {
            var elem = $("#customFields").append(
                '<tr valign="top">' +
                '<td>' +
                '<form class="form-journal">' +
                '<div class="col-3 col-md-3 form-group">' +

                '<select name="type" id="select" class="form-control"><?php echo $menu; ?></select>' +

                ' </div>' +

                '<div class="col-3 col-md-3 form-group"><input type="text" class="form-control debit-box" id="customFieldValue" name="debit" value="" placeholder="Debit  Amount" /></div>' +
                '<div class="col-3 col-md-3 form-group"><input type="text" class="form-control credit-box" id="customFieldName" name="credit" value="" placeholder="Credit  Amount" /></div>' +
                '<a href="javascript:void(0);"  class="btn remCF btn-danger">Remove</a>' +
                '<form>' +
                '</td>' +
                '</tr>'
                )
            ;
            elem.find('.credit-box').on('change keyup paste', checkCreditBox);
            elem.find('.debit-box').on('change keyup paste', checkDebitBox);

        });

        $("#customFields").on('click', '.remCF', function () {
            $(this).parent().parent().remove();
        });


        var checkCreditBox = function () {

            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }

            if (this.value.length > 0) {
                $(this).parent().parent().find('.debit-box').attr('disabled', true);
            } else {
                $(this).parent().parent().find('.debit-box').attr('disabled', false);
            }
        };

        var checkDebitBox = function () {

            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            if (this.value.length > 0) {
                $(this).parent().parent().find('.credit-box').attr('disabled', true);
            } else {
                $(this).parent().parent().find('.credit-box').attr('disabled', false);
            }
        };


        $('.credit-box').on('"change keyup paste"', checkCreditBox);
        $('.debit-box').on('"change keyup paste"', checkDebitBox);

        $('#form-cancel').on('click', function () {

            window.location = 'add_journal.php';
        });
        $("#form-submit").on('click', function (e) {

            // var data = $(this).serializeArray();
            // console.log(data);

            // alert('ok');


            var formData = new FormData();

            var data = [];
            var v_d = [];

            $('.form-journal').each(function () {
                data.push(($(this).serialize()));
                v_d.push(($(this).serializeArray()));
            });


            formData.append('file', $('#file-input')[0].files[0]);
            formData.append('data', data.join(','));
            formData.append('options', $('#journal-form').serialize());
            formData.append('extra', $('#options-form').serialize());

            if (isValidJournal(v_d) && isValidJournal(v_d) != "WRONG") {
                var url = "auth/journal.php"; // the script where you handle the form input.
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (d) {
                        console.log(JSON.stringify(d));
                        alert("Journal Added");
                        window.location = 'journals.php';
                    },
                    error: function (d, e) {
                        // alert(e);
                        alert("Journal Added");
                        console.log(JSON.stringify(d));
                    }

                });
            } else {

                if (isValidJournal(v_d) == "WRONG") {

                    alert("ZERO value journals cannot be submitted.");
                } else {

                    alert("Unbalanced journals  cannot be submitted.");
                }
            }


            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    });


    function isValidJournal(data) {

        var sum = 0;
        for (var i = 0; i < data.length; i++) {

            if (Number(data[i][1].value) === 0)
                return "WRONG";

            if (data[i][1].name === 'credit') {
                sum += Number(data[i][1].value);
            } else {
                sum -= Number(data[i][1].value);

            }

            console.log(data[i][1]);
            console.log('sum = ' + sum);
        }


        return sum === 0;
    }


</script>

</body>
</html>
