<?php
require_once dirname( __FILE__ ) . '/config/config.php';
?>
<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo SITE_NAME; ?></title>
    <meta name="description" content="Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>

<body class="bg-dark">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.php">
                    <!--					<img class="align-content" src="images/logo.png" alt="">-->
                    <h2><?php echo SITE_NAME ?></h2></a>
            </div>
            <div class="login-form">
                <form id="register-form">

                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" name="user_name">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Agree the terms and policy
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>

                    <div class="register-link m-t-15 text-center">
                        <p>Already have account ? <a href="#"> Sign in</a></p>
                    </div>
                    <div class="register-link m-t-15 text-center">
                        <p id="error-msg" style="color: red"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

<script>
    $(document).ready(function () {

        $("#register-form").submit(function (e) {

            var url = "auth/register.php"; // the script where you handle the form input.

            $.ajax({
                type: "POST",
                url: url,
                data: $("#register-form").serialize(), // serializes the form's elements.
                dataType: "json",
                success: function (data) {

                    if (data.code === 200) {
                        window.location = 'login.php'
                    } else {

                        $('#error-msg').text(data.message);
                    }

                    alert(data);

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    });
</script>


</body>
</html>
