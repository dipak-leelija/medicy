<?php

require_once '_config/sessionCheck.php';//check admin loggedin or not
require_once '../php_control/products.class.php';
// require_once '../php_control/manufacturer.class.php';
require_once '../php_control/distributor.class.php';
require_once '../php_control/measureOfUnit.class.php';
// require_once '../php_control/currentStock.class.php';
require_once '../php_control/packagingUnit.class.php';


$page = "stock-in";



//objects Initilization
$Products           = new Products();
$Distributor        = new Distributor();
// $Manufacturer       = new Manufacturer();
$MeasureOfUnits     = new MeasureOfUnits();
// $CurrentStock       = new CurrentStock();
$PackagingUnits     = new PackagingUnits();


//function's called
$showProducts          = $Products->showProducts();
$showDistributor       = $Distributor->showDistributor();
// $showManufacturer      = $Manufacturer->showManufacturer();
$showMeasureOfUnits    = $MeasureOfUnits->showMeasureOfUnits();
$showPackagingUnits = $PackagingUnits->showPackagingUnits();

$edit = FALSE;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once '../php_control/stockIn.class.php';
    require_once '../php_control/stockInDetails.class.php';

    if (isset($_GET['edit'])) {
        $edit = TRUE;

        $distBill           = $_GET['edit'];

        $StockIn            = new StockIn();
        $StockInDetails     = new StockInDetails();

        $stockIn        = $StockIn->showStockInById($distBill);
        $details = $StockInDetails->showStockInDetailsById($distBill);

   
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medicy Items</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="../css/font-awesome-6.1.1-pro.css"> -->
    <link rel="stylesheet" href="css/custom/stock-in.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- sidebar -->
        <?php include 'partials/sidebar.php'; ?>
        <!-- end sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'partials/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Add Product -->
                    <div class="card shadow mb-5">
                        <div class="card-body">

                            <!-- Distributor Details  -->
                            <div class="row bg-distributor text-light rounded py-2">
                                <div class="col-sm-6 col-md-3">
                                    <label class="mb-1" for="distributor-id">Distributor</label>
                                    <select class="upr-inp mb-1" id="distributor-id">
                                    <option value="" selected disabled>Select Distributor</option>
                                        <?php
                                                foreach($showDistributor as $rowDistributor){
                                                    $rowDistributor['name'];
                                                    echo '<option value="'.$rowDistributor['id'].'">'.$rowDistributor['name'].'</option>';
                                                }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <label class="mb-1" for="distributor-bill">Distributor Bill No.</label>
                                    <input type="text" class="upr-inp " name="distributor-bill" id="distributor-bill"
                                        placeholder="Enter Distributor Bill" autocomplete="off">
                                </div>

                                <div class="col-sm-6 col-md-2">
                                    <label class="mb-1" for="bill-date">Bill Date</label>
                                    <input type="date" class="upr-inp" name="bill-date" id="bill-date" onchange="getbillDate(this)">
                                </div>
                                <div class="col-sm-6 col-md-2">
                                    <label class="mb-1" for="due-date">Due Date</label>
                                    <input type="date" class="upr-inp" name="due-date" id="due-date">
                                </div>
                                <div class="col-md-2">
                                    <label class="mb-1" for="payment-mode">Payment Mode</label>
                                    <select class="upr-inp" name="payment-mode" id="payment-mode">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Credit" >Credit</option>
                                        <option value="Cash" >Cash</option>
                                        <option value="UPI" >UPI</option>
                                        <option value="Paypal" >Paypal</option>
                                        <option value="Bank Transfer" >Bank Transfer</option>
                                        <option value="Credit Card" >Credit Card</option>
                                        <option value="Debit Card" >Debit Card</option>
                                        <option value="Net Banking" >Net Banking</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Distributor Details  -->


                            <!-- <div class="h-divider"></div> -->
                            <hr class="sidebar-divider">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-4 mb-2">
                                        <div class="col-md-12 ">
                                            <!-- <label for="product-name" class="mb-0">Product Name</label> -->
                                            <input class="upr-inp mt-2" list="datalistOptions" id="product-name"
                                                name="product-name" placeholder="Search Product"
                                                onchange="getDtls(this.value);" autocomplete="off">
                                            <datalist id="datalistOptions">
                                                <?php
                                                foreach($showProducts as $rowProducts){
                                                    $productId   = $rowProducts['product_id'];
                                                    $productName = $rowProducts['name'];
                                                    echo '<option value="'.$productId.'">'.$productName.'</option>';
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label class="mb-0" for="manufacturer-id">Manufacturer</label>
                                            <!-- <select class="upr-inp" id="manufacturer-id" name="manufacturer-id"
                                                required>
                                                <option value="" disabled selected>Select </option>

                                            </select> -->
                                            <input class="upr-inp d-none" id="manufacturer-id" name="manufacturer-id"
                                                value="">
                                            <input class="upr-inp" id="manufacturer-name" name="manufacturer-name"
                                                value="">


                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="row ">

                                                <div class="col-sm-6 col-md-3 mt-2 ">
                                                    <label class="mb-0" for="weightage">Weightage</label>
                                                    <input type="text" class="upr-inp" id="weightage" value="" readonly>
                                                </div>

                                                <div class="col-sm-6 col-md-3 mt-2 ">
                                                    <label class="mb-0" for="unit"> Unit</label>
                                                    <input type="text" class="upr-inp" id="unit" value="" readonly>
                                                </div>

                                                <div class="col-sm-6 col-md-3 mt-2 ">
                                                    <label class="mb-0" for="packaging-in">Packaging-in</label>
                                                    <input type="text" class="upr-inp" id="packaging-in" value=""
                                                        readonly>
                                                </div>
                                                <div class="col-sm-6 col-md-3 mt-2 ">
                                                    <label class="mb-0" for="medicine-power">Medicine Power</label>
                                                    <input class="upr-inp" type="text" name="medicine-power"
                                                        id="medicine-power">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col-sm-6 col-md-4 mt-2">
                                            <label class="mb-0" for="batch-no">Batch No.</label>
                                            <input type="text" class="upr-inp" name="batch-no" id="batch-no">
                                        </div>
                                        <div class="col-sm-6 col-md-4 mt-2">
                                            <label class="mb-0 mt-1" for="exp-date">Expiry Date</label>
                                            <div class="d-flex date-field">
                                                <input class="month " type="number" id="exp-month"
                                                    onkeyup="setMonth(this);">
                                                <span class="date-divider">&#47;</span>
                                                <input class="year " type="number" id="exp-year"
                                                    onkeyup="setYear(this);">
                                            </div>
                                        </div>
                                        <div class="d-none col-md-4 mt-2">
                                            <label class="mb-0" for="product-id">Product Id</label>
                                            <input class="upr-inp" id="product-id" name="product-id" readonly>
                                        </div>
                                    </div>
                                    <!--/End Quantity Row  -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Price Row -->
                                    <div class="row mb-2">

                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="mrp">MRP/Package</label>
                                            <input type="number" class="upr-inp" name="mrp" id="mrp">
                                        </div>

                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="purchase-price">PTR/Package</label>
                                            <input type="number" class="upr-inp" name="ptr" id="ptr"
                                                onkeyup="getBillAmount()">
                                        </div>
                                    </div>
                                    <!--/End Price Row -->

                                    <div class="row">

                                        <div class="col-sm-6 col-md-3 mt-2">
                                            <label class="mb-0" for="qty">Quantity</label>
                                            <input type="number" class="upr-inp" name="qty" id="qty"
                                                onkeyup="getBillAmount()">
                                        </div>
                                        <div class="col-sm-6 col-md-3 mt-2">
                                            <label class="mb-0" for="free-qty">Free</label>
                                            <input type="number" class="upr-inp" name="free-qty" id="free-qty">
                                        </div>


                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="packaging-type">Packaging Type</label>
                                            <select class="upr-inp" name="packaging-type" id="packaging-type">
                                                <option value="" disabled selected>Select Packaging Type </option>
                                                <?php
                                                    foreach ($showPackagingUnits as $rowPackagingUnits) {
                                                        echo '<option value="'.$rowPackagingUnits['id'].'">'.$rowPackagingUnits['unit_name'].'</option>';
                                                    }
                                                    ?>
                                            </select>
                                        </div>

                                        <!-- </div> -->
                                        <!--/End Quantity Row  -->

                                        <!-- Price Row -->
                                        <!-- <div class="row"> -->

                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="discount">Discount % / Unit</label>
                                            <input type="number" class="upr-inp" name="discount" id="discount"
                                                placeholder="Discount Percentage" value="0" onkeyup="getBillAmount()">
                                        </div>

                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="gst">GST</label>
                                            <input type="number" class="upr-inp" name="gst" id="gst" readonly>
                                        </div>

                                        <!-- </div> -->
                                        <!--/End Price Row -->

                                        <!-- Quantity Row  -->
                                        <!-- <div class="row"> -->
                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <label class="mb-0" for="base">Base</label>
                                            <input type="number" class="upr-inp" name="base" id="base">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label class="mb-0" for="bill-amount">Bill Amount</label>
                                            <input type="any" class="upr-inp" name="bill-amount" id="bill-amount"
                                                readonly required>
                                        </div>
                                    </div>
                                    <!--/End Quantity Row  -->

                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-md-2">
                                <button class="btn btn-primary me-md-2" onclick="addData()">Add
                                    <i class="fas fa-plus"></i></button>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <!-- /end Add Product  -->

                    <!--=========================== Show Bill Items ===========================-->
                    <div class="card shadow mb-4">
                        <form action="_config\form-submission\stock-in-form.php" method="post">
                            <div class="card-body stock-in-summary">
                                <div class="table-responsive">


                                    <table class="table item-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"><input type="number" value="0" id="dynamic-id"
                                                        style="display:none"></th>
                                                <th scope="col">Items</th>
                                                <th scope="col">Batch</th>
                                                <th scope="col">Exp.</th>
                                                <th scope="col">Power</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Qty.</th>
                                                <th scope="col">Free</th>
                                                <th scope="col">MRP</th>
                                                <th scope="col">PTR</th>
                                                <th scope="col">Base</th>
                                                <th scope="col">Margin%</th>
                                                <th scope="col">GST%</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataBody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="m-3 p-3 pt-3 font-weight-bold text-light purchase-items-summary rounded">
                                <div class="row mb-3">
                                    <div class="col-md-3  d-flex justify-content-start">
                                        <p>Distributor :
                                            <input class="summary-inp w-60" name="distributor-id" id="distributor-name"
                                                type="text"
                                                value=""
                                                readonly>

                                            <!-- <input  class="summary-inp"
                                                    name="distributor-id"
                                                    id="distributor-name"
                                                    type="text"
                                                    readonly> -->
                                        </p>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-start">
                                        <p>Dist. Bill :
                                            <input class="summary-inp w-65" name="distributor-bill" id="distributor-bill-no"
                                                type="text"
                                                value=""
                                                readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-3  d-flex justify-content-start">
                                        <p>Bill Date :
                                            <input class="summary-inp w-65" name="bill-date-val" id="bill-date-val"
                                                type="text"
                                                value=""
                                                readonly>
                                        </p>
                                    </div>
                                    <div class="col-md-3  d-flex justify-content-start">
                                        <p>Due Date :
                                            <input class="summary-inp w-65" name="due-date-val" id="due-date-val"
                                                type="text"
                                                value="<?php if ($edit == TRUE) { echo $stockIn[0]['due_date']; }?>"
                                                readonly>
                                        </p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-3 d-flex justify-content-start">
                                        <span>Payment :
                                            <input class="summary-inp w-65" name="payment-mode-val" id="payment-mode-val"
                                                type="text"
                                                value="0"
                                                readonly>
                                        </span>
                                    </div>

                                    <div class="col-sm-6 col-md-2  d-flex justify-content-start">
                                        <p>Items :
                                            <input class="summary-inp w-65" name="items" id="items-val" type="text"
                                                value="0" readonly>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 col-md-2 d-flex justify-content-start">
                                        <p>Qty :
                                            <input class="summary-inp w-65" name="total-qty" id="qty-val" type="text"
                                                value="0"
                                                readonly>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 col-md-2 d-flex justify-content-start">
                                        <p>GST :
                                            <input class="summary-inp w-65" name="totalGst" id="gst-val" type="text"
                                                value="0" readonly>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 col-md-3  d-flex justify-content-start">
                                        <p>Net :
                                            <input class="summary-inp w-65" name="netAmount" id="net-amount" type="text"
                                                value="0"
                                                readonly>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex  justify-content-end">
                                <button class="btn btn-sm btn-primary" style="width: 8rem;" type="submit"
                                        name="stock-in">Save</button>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--=========================== Show Bill Items ===========================-->


                </div>
                <!-- /.container-fluid -->
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include_once 'partials/footer-text.php'; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <?php require_once '_config/logoutModal.php'; ?>
        <!--End of Logout Modal-->

        <!-- Bootstrap core JavaScript-->
        <script src="../assets/jquery/jquery.min.js"></script>
        <script src="../js/bootstrap-js-4/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="../js/ajax.custom-lib.js"></script>
        <script src="../js/sweetAlert.min.js"></script>
        <script src="js/stock-in.js"></script>

</body>

</html>