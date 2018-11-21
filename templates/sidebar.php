<?php

?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">

            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="dash.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <h3 class="menu-title">Add</h3><!-- /.menu-title -->
                <li>
                    <a href="add_account.php"> <i class="menu-icon ti-briefcase"></i>Account </a>

					<?php if ( isset( $_SESSION['group'] ) && ( $_SESSION['group'] == 'manager' || $_SESSION['group'] == 'user' ) ) { ?>
                        <a href="add_journal.php"> <i class="menu-icon ti-harddrive"></i>Journal </a>
					<?php } ?>

					<?php if ( isset( $_SESSION['group'] ) && ( $_SESSION['group'] == 'admin' ) ) { ?>
                        <a href="add_user.php"> <i class="menu-icon ti-user"></i>User </a>
					<?php } ?>

                </li>
                <h3 class="menu-title">View</h3><!-- /.menu-title -->
                <li>
                    <a href="accounts.php"> <i class="menu-icon ti-briefcase"></i>Accounts </a>
                    <a href="journals.php"> <i class="menu-icon ti-harddrive"></i>Journals </a>
                    <a href="ledgers.php"> <i class="menu-icon ti-harddrive"></i>Ledgers </a>

                    <a href="users.php"> <i class="menu-icon ti-user"></i>Users </a>
                </li>


                <h3 class="menu-title">Statements</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Statements</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="trial_balance.php">Trial Balance</a>
                        </li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="income_statement.php">Income
                                Statement</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="retained_earnings.php">Retained
                                Earnings</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="balance_sheet.php">Balance Sheet</a>
                        </li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="closing_journal.php">Closing Journal
                                Entries</a>
                        </li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="post_trial_balance.php">Post Closing
                                Trial
                                Balance</a>
                        </li>


                    </ul>
                </li>

				<?php if ( isset( $_SESSION['group'] ) && ( $_SESSION['group'] == 'manager' || $_SESSION['group'] == 'admin' ) ) { ?>
                    <h3 class="menu-title">Event</h3><!-- /.menu-title -->
                    <li>
                        <a href="logs.php"> <i class="menu-icon ti-briefcase"></i>Logs </a>
                    </li>
				<?php } ?>

            </ul>


        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
