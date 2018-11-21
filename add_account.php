<?php require_once 'templates/header.php'; ?>
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
                    <h1>Accounts</h1>
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
                            <strong>Create New Account</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" id="account-form" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label class=" form-control-label">Account Number</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" name="account_number"
                                               value="">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input"
                                                                     class=" form-control-label">Name</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="text" id="text-input" name="name"
                                               placeholder="John Doe" class="form-control">
                                        <small class="form-text text-muted">Enter full name</small>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select"
                                                                     class=" form-control-label">Normal Side</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="normal_side" id="select" class="form-control">
                                            <option value="R">R</option>
                                            <option value="L">L</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select"
                                                                     class=" form-control-label">Type</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="type" id="select" class="form-control">
                                            <option value="asset">asset</option>
                                            <option value="liability">liability</option>
                                            <option value="equity">equity</option>
                                            <option value="revenue">revenue</option>
                                            <option value="expenses">expenses</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="email-input"
                                                                     class=" form-control-label">Sub Type</label>
                                    </div>
                                    <div class="col-12 col-md-9"><input type="text" id="email-input"
                                                                        name="sub_type"
                                                                        placeholder=""
                                                                        class="form-control">

                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="email-input"
                                                                     class=" form-control-label">Initial Balance</label>
                                    </div>
                                    <div class="col-12 col-md-9"><input type="number" id="email-input"
                                                                        name="initial_balance"
                                                                        placeholder="00000"
                                                                        class="form-control">
                                        <small class="help-block form-text">Please enter the initial balance</small>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Comment</label>
                                    </div>
                                    <div class="col-12 col-md-9"><textarea name="comments" id="textarea-input"
                                                                           rows="9" placeholder="Comments..."
                                                                           class="form-control"></textarea></div>
                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary btn-sm">

                                </div>

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

        $("#account-form").on('submit', function (e) {

            // var data = $(this).serializeArray();
            // console.log(data);


            var url = "auth/account.php"; // the script where you handle the form input.

            $.ajax({
                type: "POST",
                url: url,
                data: $("#account-form").serialize(),
                dataType: "json",
                success: function (d) {
                    alert(d.message);
                },
                error: function (d, e) {
                    // alert(e);
                    alert(JSON.stringify(d));
                }

            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    });

</script>
</body>
</html>
