<?php require_once 'templates/header.php'; ?>
<?php try {
	$users = User::all();
} catch ( Exception $e ) {
	$users = [];
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
                    <h1>Manage Users</h1>
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

                <div class="col-lg-12 align-content-lg-center align-items-center">
                    <div class="card">
                        <div class="card-header">
                            <strong>Update user role</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal" id="user-form">

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select"
                                                                     class=" form-control-label">User Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="user" id="select" class="form-control">

											<?php
											foreach ( $users as $user ) {

												echo '<option value=' . $user->id . '>' . $user->user_name . '</option>';

											}
											?>

                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select"
                                                                     class=" form-control-label">Roles</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="role" id="select" class="form-control">
                                            <option value="user">User</option>
                                            <option value="manager">Manager</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
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


<script>

    $(document).ready(function () {

        $("#user-form").submit(function (e) {

            var url = "auth/user.php"; // the script where you handle the form input.

            $.ajax({
                type: "POST",
                url: url,
                data: $("#user-form").serialize(), // serializes the form's elements.
                dataType: "json",
                success: function (data) {

                    // alert(JSON.stringify(data));
                    alert(data.message);

                }
                ,
                error: function (d, e) {
                    alert(JSON.stringify(d));
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    });


</script>

</body>
</html>
