<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                <button class="search-trigger"><i class="fa fa-search"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                               aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div>


            </div>
        </div>

        <div class="col-sm-5 col-md-5">
            <div class="col-md-2 col-sm-2 float-right">

				<div class="bg-transparent"><?php echo $_SESSION['user_name']; ?></div>
				<a class="bg-transparent" href="auth/logout.php">Logout</a>

            </div>



        </div>
    </div>

</header><!-- /header -->