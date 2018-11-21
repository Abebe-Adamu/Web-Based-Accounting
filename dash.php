<?php require_once 'templates/header.php'; ?>
<body>
<!-- Left Panel -->
<?php require_once 'templates/sidebar.php'; ?>


<?php

$accounts = Account::sql("SELECT count(id) as noOfAccount FROM :TABLE", SimpleOrm::FETCH_ONE);
$noOfAccounts = $accounts->noOfAccount;

$journals = Journal::sql("SELECT count(id) as noOfJournals FROM :TABLE", SimpleOrm::FETCH_ONE);
$noOfJournals = $journals->noOfJournals;;

$currentAssets = Account::getCurrentAssetsSum();
$currentLiabilities = Account::getCurrentLiabilitiesSum();
$currentRatio = ($currentAssets / $currentLiabilities);
$currentRatioClass = '';
if ($currentRatio < 2) {
    $currentRatioClass = 'bg-flat-color-4 '; //red
} else if ($currentRatio < 5) {
    $currentRatioClass = 'bg-flat-color-3 '; //yello
} else {
    $currentRatioClass = 'bg-flat-color-5'; //green
}


$supplies = Account::getSupplies();
$quickRatio = (($currentAssets - $supplies) / $currentLiabilities);
$quickRatioClass = '';
if ($quickRatio < 2) {
    $quickRatioClass = 'bg-flat-color-4 '; //red
} else if ($quickRatio < 4) {
    $quickRatioClass = 'bg-flat-color-3 '; //yello
} else {
    $quickRatioClass = 'bg-flat-color-5'; //green
}


$totalRevenue = Account::getTotalRevenue();
$totalAssets = $currentAssets + Account::getEquipmentsSum();

$returnOnAsset = ($totalRevenue / $totalAssets);

$returnOnAssetClass = '';
if ($returnOnAsset < 5) {
    $returnOnAssetClass = 'bg-flat-color-4 '; //red
} else if ($returnOnAsset < 10) {
    $returnOnAssetClass = 'bg-flat-color-3 '; //yello
} else {
    $returnOnAssetClass = 'bg-flat-color-5'; //green
}


$totalLiabilities = Account::getLiabilitiesSum();
$debtRatio = ($totalLiabilities / $totalAssets);

$debtRatioClass = '';
if ($debtRatio < 5) {
    $debtRatioClass = 'bg-flat-color-4 '; //red
} else if ($debtRatio < 10) {
    $debtRatioClass = 'bg-flat-color-3 '; //yello
} else {
    $debtRatioClass = 'bg-flat-color-5'; //green
}

//print_r($supplies . ': ' . $currentAssets . ' : ' . $currentLiabilities);
$inventoryToNetworkingCapital = ($supplies / ($currentAssets + $currentLiabilities));


$inventoryToNetworkingCapitalClass = '';
if ($inventoryToNetworkingCapital < 5) {
    $inventoryToNetworkingCapitalClass = 'bg-flat-color-4 '; //red
} else if ($inventoryToNetworkingCapital < 10) {
    $inventoryToNetworkingCapitalClass = 'bg-flat-color-3 '; //yello
} else {
    $inventoryToNetworkingCapitalClass = 'bg-flat-color-5'; //green
}


//print_r($totalLiabilities . ' ' . $totalAssets);

//die($currentAssets . ' : ' . $currentLiabilities . ': ' . $currentRatio);
?>
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
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">


        <div class="col-sm-3 col-lg-3">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $noOfAccounts ?></span>
                    </h4>
                    <p class="text-light">Total Accounts</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart1"></canvas>
                    </div>

                </div>

            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-3 col-lg-3">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $noOfJournals ?></span>
                    </h4>
                    <p class="text-light">Total Journals</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-sm-3 col-lg-3">
            <div class="card text-white <?= $currentRatioClass ?>">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $currentRatio ?></span>
                    </h4>
                    <p class="text-light">Current Ratio</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-3 col-lg-3">
            <div class="card text-white <?= $quickRatioClass ?>">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $quickRatio ?></span>
                    </h4>
                    <p class="text-light">Quick Ratio</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-3 col-lg-3">
            <div class="card text-white <?= $returnOnAssetClass ?>">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $returnOnAsset ?></span>
                    </h4>
                    <p class="text-light">Return on Assets</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-3 col-lg-3">
            <div class="card text-white <?= $debtRatioClass ?>">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $debtRatio ?></span>
                    </h4>
                    <p class="text-light">Debt Ratio</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="card text-white <?= $inventoryToNetworkingCapitalClass ?>">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>

                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?php echo $inventoryToNetworkingCapital ?></span>

                    </h4>
                    <p class="text-light">Inventory to Networking Capital</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>


        <!--/.col-->


        <!---->
        <!---->
        <!--        <div class="col-xl-3 col-lg-6">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <div class="stat-widget-one">-->
        <!--                        <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>-->
        <!--                        <div class="stat-content dib">-->
        <!--                            <div class="stat-text">Total Profit</div>-->
        <!--                            <div class="stat-digit">1,012</div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!---->
        <!---->
        <!--        <div class="col-xl-3 col-lg-6">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <div class="stat-widget-one">-->
        <!--                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>-->
        <!--                        <div class="stat-content dib">-->
        <!--                            <div class="stat-text">New Customer</div>-->
        <!--                            <div class="stat-digit">961</div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!---->
        <!--        <div class="col-xl-3 col-lg-6">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <div class="stat-widget-one">-->
        <!--                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>-->
        <!--                        <div class="stat-content dib">-->
        <!--                            <div class="stat-text">Active Projects</div>-->
        <!--                            <div class="stat-digit">770</div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!---->
        <!--       -->

    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script>
</script>

</body>
</html>
