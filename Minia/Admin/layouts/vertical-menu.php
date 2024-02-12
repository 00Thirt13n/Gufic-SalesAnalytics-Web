
<?php
require_once "layouts/config.php";
session_start();
$username = $_SESSION['samplename'];
$user_id = $_SESSION['user_id'];

$billing_detail = 'https://gufic.globalspace.in/billing/' ;
$app_details = 'https://gufic.globalspace.in/sparsh/';

$menuItems = [
    "Dashboard" => $billing_detail."index.php",
    // "Dashboard" => [
    //     "CFA" => $billing_detail."cfa-index.php",
        "Leaderboard" => $billing_detail."leader-dashboard.php",
    // ],
    "Reports" => [
        // "Template" => [
        //     "Master" => $billing_detail."master-template.php",
        // ],

        // "RCPA" => [
        //     "Hospital RCPA" => $billing_detail."RCPA-Hospital.php",
        //     "Consumption" => [
        //         "Gufic Consumption" => $billing_detail."Gufic-Consumption.php",
        //         "Other Consumption" => $billing_detail."Other-Consumption.php"
        //     ]
        // ],
        "Sales" => [
            "CFA Wise" => $billing_detail."CFA-Wise.php",
            "CFA-Product Wise" => $billing_detail."CFA-Wise-Product-Wise.php",
            "CFA-Hospital Wise" => $billing_detail."CFA-Wise-Hospital.php",
            "Hospital Wise" => $billing_detail."Hospital-Wise.php",
            "Product Wise" =>"Product-Wise.php",
            "Hospital-Product Wise" => $billing_detail."Hospital-Wise-Product-Wise.php",
            "Employee/HQ Wise" => $billing_detail."HQ-Wise.php",
            "Transaction Wise" => $billing_detail."Transaction-Wise.php",
            // "Product Wise Average" => $billing_detail."average-sales-report.php"
        ],
        "Collection" => [
            // "Collection Summary Report" => $billing_detail."TransactionSummaryReport.php",
            
            "CFA Wise Collection" => $billing_detail."CFACollectionSummary.php",
            
            "Employee/HQ Wise Collection" => $billing_detail."HQWiseCollection.php",
            "Party-Wise Collection" => $billing_detail."PartyWiseCollectionDetails.php",
            //"Hospital Wise Collection" => $billing_detail."CFAHospitalCollection.php",
            "Collection Summary Report" => $billing_detail."CollectionSummaryReport.php"


        ],
        "Outstanding" => [
            
            "CFA Wise Outstanding" => $billing_detail."CFAWiseOutstanding.php",
            
            "HQ Wise Outstanding" => $billing_detail."HQWiseOutstanding.php",
            "Party Wise Outstanding" => $billing_detail."PartyWiseOutstanding.php",
            // "Aging Summary" => $billing_detail."AgingSummary.php",
            "Top Parties With Highest Outstanding" => $billing_detail."TopParties.php"
        ],
        
        "Stock" => [
            
            "CFA Wise Product Stock" => $billing_detail."CFA_Wise_Product_Stock.php",
            "Product Stock(All India)" => $billing_detail."ProductStockAllIndia.php",
            //"near expiry stock(All India)" => $billing_detail."NearExpiryAllIndia.php",
            "CFA-Wise Product-Wise NearExpiry Stock" => $billing_detail."CFA_NearExpiry.php"
        ],

        "Trend Reports" => [
            "Product Trend Report" => $billing_detail."trend-report.php",
            "Employee Trend Report" => $billing_detail."emp-trend-report.php",
            "All Employee Product Trend Report" => $billing_detail."trend-product-all-emp-report.php",
            "All Employee Trend Report" => $billing_detail."trend-all-emp-report.php",
            "CFA Trend Report" => $billing_detail."cfa-trend-report.php"
            //"Hierarchy Trend Report" => $billing_detail."HierarchyWiseSalesTrend.php",

        ],

        // "Target Reports" => [
        //     "Target vs Achievement Report" => $billing_detail."target-report.php",
        //     "Target Sheet" => $billing_detail."target-data.php"
        // ],
        
        // "Overall Sales Report" => $billing_detail."Overall-Sales-Report.php", //OLD & SLOW
        "Overall Sales Report" => $billing_detail."overall-sales.php"
    ],

    // "Incentive" => [
    //     "Dashboard" => $billing_detail."pages-maintenance.php",
    //     "Simulator" => $billing_detail."pages-maintenance.php",
    //     "Matrix" => $billing_detail."pages-maintenance.php"
    // ],


];


if($_SESSION['is_admin'] == true){

    $IMS_Billings = [
        "Dashboard" => $billing_detail."IMS-index.php",
    
        "Reports" => [
            "Sales" => [
                "Product Wise" => $billing_detail."IMS-Product-Wise.php",
                "Hospital Wise" => $billing_detail."IMS-Hospital-Wise.php",
                "Hospital-Product Wise" => $billing_detail."IMS-Hospital-Product-Wise.php",
                "Employee Wise" =>"IMS-Employee-Wise.php",
                "Employee Product Wise" =>"IMS-Employee-Product-Wise.php",
            ],

            "Trend Reports" => [
            "Product Trend Report" => $billing_detail."IMS-Product-Trend.php"
            ],
            
            "Stock" => [
                "Product Stock IMS" => $billing_detail."IMS-Product-Stock.php",
                "NearExpiry Stock" => $billing_detail."IMS-Near-Expiry-Stock.php"
            ],
        ],
    ];

    $Admin_Panel = [
        // "Order Manupulation" => $billing_detail."Order_Operation.php",
        //"Order Cancellation" => $billing_detail."Order_Cancellation.php",
    ];
}



// $ftpReports = [
//     "Dashboard" => $billing_detail."FTP_Dashboard.php",
//     "Sales Details" => $billing_detail."FTP_SalesDetails.php",
//     "Outstanding Analysis" => $billing_detail."FTP_OutstandingAnalysis.php",
//     "Stock Statement" => $billing_detail."FTP_StockStatement.php",
//     "Collection Summary" => $billing_detail."FTP_CollectionSummary.php"
// ];

// $isAdmin = ($user_id == 'MEMP_G_16');
?>

<header id="page-topbar" style="background-color:#f9f9f9;">
    <div class="navbar-header">
        <div class="d-flex ">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color:#f9f9f9;">
                <a href="<?= $app_details ?>index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/mediola/circle-logo.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/mediola/mediola-logo.svg" alt="" height="24"> <span class="logo-txt"></span>
                    </span>
                </a>

                <a href="<?= $app_details ?>index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/mediola/circle-logo.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/mediola/mediola-logo.svg" alt="" height="24"> <span class="logo-txt"></span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="user"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium h6"><?php print_r($username); ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    <br>
                </button>
                
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item d-lg-none" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> <?php print_r($username); ?></a>
                    <hr>
                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> <?php echo "Logout"; ?></a>
                </div>
            </div>

        </div>
    </div>
</header>


<!-- Left Sidebar -->
<div class="vertical-menu" style="background-color:#f9f9f9;">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu" >
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu" >Menu</li>
                <li class="menu-title" data-key="t-menu" >Actual Billing Sales</li>

                <?php foreach ($menuItems as $menuItem => $submenu) : ?>
                    <?php if (is_array($submenu)) : ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" >
                                <i data-feather="grid"></i>
                                <span data-key="t-invoices"><?= $menuItem ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php foreach ($submenu as $subItem => $subLink) : ?>

                                    <?php if (is_array($subLink)) : ?>
                                        
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow" >
                                                <i data-feather="grid"></i>
                                                <span data-key="t-invoices"><?= $subItem ?></span>
                                            </a>

                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php foreach ($subLink as $subsubItem => $subsubLink) : ?>
                                                    

                                                    <?php if (is_array($subsubLink)) : ?>
                                        
                                                        <li>
                                                            <a href="javascript: void(0);" class="has-arrow" >
                                                                <i data-feather="grid"></i>
                                                                <span data-key="t-invoices"><?= $subsubItem ?></span>
                                                            </a>

                                                            <ul class="sub-menu" aria-expanded="false">
                                                                <?php foreach ($subsubLink as $subsubsubItem => $subsubsubLink) : ?>

                                                                    <li><a href="<?= $subsubsubLink ?>"><?= $subsubsubItem ?></a></li>
                                                                
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </li>

                                                    <?php else : ?>
                                                        <li>
                                                            <a href="<?= $subsubLink ?>" >
                                                                <i data-feather="file"></i>
                                                                <span data-key="t-dashboard"><?= $subsubItem ?></span>
                                                            </a>
                                                        </li>

                                                    <?php endif; ?>
                                                    
                                                
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>

                                    <?php else : ?>
                                        <li>
                                            <a href="<?= $subLink ?>" >
                                                <i data-feather="file"></i>
                                                <span data-key="t-dashboard"><?= $subItem ?></span>
                                            </a>
                                        </li>

                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?= $submenu ?>" >
                                <i data-feather="file"></i>
                                <span data-key="t-dashboard"><?= $menuItem ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

<!-------------------------------- IMS BILLING ADMIN PANEL -------------------------------->

<?php if($_SESSION['is_admin'] == true) : ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="grid"></i>
                            <span data-key="t-contacts">IMS Billing</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php foreach ($IMS_Billings as $adminItem => $adminMenu) : ?>
                                <?php if (is_array($adminMenu)) : ?>        
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow" >
                                                <i data-feather="grid"></i>
                                                <span data-key="t-invoices"><?= $adminItem ?></span>
                                            </a>

                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php foreach ($adminMenu as $subItem => $subLink) : ?>

                                                    <!-- <li><a href="<?//= $subLink ?>"><?//= $subItem ?></a></li> -->
                                                    <?php if (is_array($adminMenu)) : ?>        
                                                        <li>
                                                            <a href="javascript: void(0);" class="has-arrow" >
                                                                <i data-feather="grid"></i>
                                                                <span data-key="t-invoices"><?= $subItem ?></span>
                                                            </a>

                                                            <ul class="sub-menu" aria-expanded="false">
                                                                <?php foreach ($subLink as $subsubItem => $subsubLink) : ?>

                                                                    <li><a href="<?= $subsubLink ?>"><?= $subsubItem ?></a></li>
                                                                
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </li>

                                                    <?php else : ?>
                                                        <li>
                                                            <a href="<?= $subLink ?>" >
                                                                <i data-feather="file"></i>
                                                                <span data-key="t-dashboard"><?= $subsubItem ?></span>
                                                            </a>
                                                        </li>

                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>

                                    <?php else : ?>
                                        <li>
                                            <a href="<?= $adminMenu ?>" >
                                                <i data-feather="file"></i>
                                                <span data-key="t-dashboard"><?= $adminItem ?></span>
                                            </a>
                                        </li>

                                <?php endif; ?>
                            <?php endforeach; ?> 

                        </ul>
                    </li>
                <?php endif; ?>

<!-------------------------------- IMS BILLING ADMIN PANEL -------------------------------->


<!-------------------------------- BILLING ADMIN PANEL -------------------------------->

                <?php if($_SESSION['is_admin'] == true) : ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="grid"></i>
                            <span data-key="t-contacts">Admin Panel</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php foreach ($Admin_Panel as $adminItem => $adminMenu) : ?>
                                <li><a href="<?= $adminMenu ?>" >
                                    <i data-feather="file"></i>
                                    <span data-key="t-dashboard"><?= $adminItem ?></a></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>

<!-------------------------------- BILLING ADMIN PANEL -------------------------------->


<hr>


<!-------------------------------- SPARSH APP -------------------------------->
                <li class="menu-title " data-key="t-menu"><?php echo "Sparsh App"; ?></li>



                <li>
                    <a href="<?= $app_details ?>index.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo "HOME"; ?></span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="grid"></i> 
                        <span data-key="t-invoices"><?php echo "Dashboard"; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= $app_details ?>cfa-index2.php" ><?php echo "CFA "; ?></a></li>
                        <li><a href="<?= $app_details ?>leader-dashboard.php" ><?php echo "Leaderboard "; ?></a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-apps"><?php echo "Reports"; ?></span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices"><?php echo "RCPA"; ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?= $app_details ?>RCPA-Hospital.php">
                                        <span data-key="t-invoices"><?php echo "Hospital RCPA"; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-invoices"><?php echo "Consumption"; ?></span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li>
                                            <a href="<?= $app_details ?>Gufic-Consumption.php">
                                                <span data-key="t-invoices"><?php echo "Gufic Consumption"; ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= $app_details ?>Other-Consumption.php">
                                                <span data-key="t-invoices"><?php echo "Other Consumption"; ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices"><?php echo "Sales"; ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?= $app_details ?>HQ-Wise.php">
                                        <span data-key="t-invoices"><?php echo "HQ Wise"; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $app_details ?>Product-Wise-Sales.php">
                                        <span data-key="t-invoices"><?php  echo "Product Wise"; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $app_details ?>Hospital-Wise.php">
                                        <span data-key="t-invoices"><?php  echo "Hospital Wise"; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $app_details ?>average-sales-report.php">
                                        <span data-key="t-invoices"><?php echo "Product Wise Average"; ?></span>
                                    </a>
                                </li>        
                            </ul>
                        </li>

                        <!-- <li>
                            <a href="<?= $app_details ?>trend-report.php">
                                <span data-key="t-invoices"><?php //echo "Trend Report"; ?></span>
                            </a>
                        </li> -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices"><?php echo "Trend Reports"; ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?= $app_details ?>trend-report.php">
                                    <span data-key="t-invoices"><?php echo "Product Trend Report"; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $app_details ?>emp-trend-report.php">
                                    <span data-key="t-invoices"><?php echo "Employee Trend Report"; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $app_details ?>cfa-trend-report.php">
                                    <span data-key="t-invoices"><?php echo "CFA Trend Report"; ?></span>
                                </a>
                            </li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices"><?php echo "Target Reports"; ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="<?= $app_details ?>target-report.php">
                                    <span data-key="t-invoices"><?php echo "Target vs Achievement Report"; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $app_details ?>target-data.php">
                                    <span data-key="t-invoices"><?php echo "Target Sheet"; ?></span>
                                </a>
                            </li>

                            </ul>
                        </li>

                        <li>
                            <a href="<?= $app_details ?>overall-sales.php">
                                <span data-key="t-invoices"><?php echo "Overall Sales Report"; ?></span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-contacts"><?php echo "Incentive"; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= $app_details ?>pages-maintenance.php" data-key="t-profile"><?php echo "Dashboard" ?></a></li>
                        <li><a href="<?= $app_details ?>pages-maintenance.php" data-key="t-user-grid"> <?php echo "Simulator" ?></a></li>
                        <li><a href="<?= $app_details ?>pages-maintenance.php" data-key="t-user-list"> <?php echo "Matrix" ?></a></li>
                        <!-- <li><a href="<?= $app_details ?>pages-maintenance.php" data-key="t-profile"><?php // echo "Planner" ?></a></li> -->
                    </ul>
                </li>


<!-------------------------------- APP ADMIN PANEL -------------------------------->


                <?php 
                    if ($_SESSION['is_admin'] == true) : ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i> 
                                <span data-key="t-contacts"><?php echo "Admin Panel"; ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                    
                                <li><a href="<?= $app_details ?>add-users.php" data-key="t-user-list"><?= "Add User" ?></a></li>
                                <li><a href="<?= $app_details ?>add-product.php" data-key="t-user-list"><?= "Add Product" ?></a></li>
                                <li><a href="<?= $app_details ?>approval-matrix.php" data-key="t-user-list"><?= "Approval Matrix" ?></a></li>
                                <li><a href="<?= $billing_detail ?>SpecialPriceReset.php" data-key="t-user-list"><?= "Special Price Reset" ?></a></li>
                                <li><a href="<?= $billing_detail ?>Order_Cancellation.php" data-key="t-user-list"><?= "Order Cancellation" ?></a></li>

                                        
                            </ul>
                        </li>
                <?php endif; ?>




<!-------------------------------- APP ADMIN PANEL -------------------------------->

            
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
