<?php

require_once '_config/sessionCheck.php';//check admin loggedin or not
require_once '../php_control/products.class.php';
require_once '../php_control/distributor.class.php';
require_once '../php_control/stockReturn.class.php';
require_once '../php_control/employee.class.php';


$page = "stock-return";

//objects Initilization
// $Products           = new Products();
$Distributor        = new Distributor();
$StockReturn        = new StockReturn();
$Employees          = new Employees();

//function's called
$showDistributor       = $Distributor->showDistributor();
$stockReturnLists      = $StockReturn->showStockReturn();
//print_r($stockReturnLists);
$empLists              = $Employees->employeesDisplay();


 
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

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom/return-page.css">

    <!-- Datatable Style CSS -->
    <link href="vendor/product-table/dataTables.bootstrap4.css" rel="stylesheet">


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

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">

                    </div>
                    <!-- Add Product -->
                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <div class="row mb-3 ">
                                <div class="col-md-1 col-12">
                                    <label for="">Filter By:</label>

                                </div>

                                <div class="col-md-3 col-12">
                                    <!-- <label class="mb-0 mt-2" for="payment-mode">01/04/2022-31/03/2022</label> -->
                                    <select class="cvx-inp1" name="payment-mode" id="payment-mode">
                                        <option value="" selected disabled>01/04/2022-31/03/2022 </option>
                                        <option value="Credit">Today</option>
                                        <option value="Cash">yesterday</option>
                                        <option value="UPI">Last 7 Days</option>
                                        <option value="Paypal">Last 30 Days</option>
                                        <option value="Bank Transfer">Last 90 Days</option>
                                        <option value="Credit Card">Current Fiscal Year</option>
                                        <option value="Debit Card">Previous Fiscal Year</option>
                                        <option value="Net Banking">Custom Range </option>
                                    </select>

                                </div>
                                <div class="col-md-2 col-6">
                                    <select class="cvx-inp1" id="added_by" onchange="returnFilter(this)">
                                        <option value="" disabled selected>Select Staff
                                        </option>
                                        <?php
                                                foreach($empLists as $emp){
                                                    echo '<option value="'.$emp['employee_username'].'">'.$emp['employee_username'].'</option>';
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2 col-6">
                                    <input class="cvx-inp" type="text" placeholder="Distributor Name"
                                        name="distributor_id" id="distributor_id" style="outline: none;"
                                        onkeyup="returnFilter(this)">
                                </div>
                                <div class="col-md-2 col-6">
                                    <select class="cvx-inp1" name="refund_mode" id="refund_mode"
                                        onchange="returnFilter(this)">
                                        <option value="" selected disabled>payment Mode</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Cash">Cash</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Net Banking">Net Banking</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-6 text-right">
                                    <a class="btn btn-sm btn-primary " href="stock-return-item.php"> New <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>

                            <div class="table-responsive" id="filter-table">
                                <table class="table table-sm table-hover" id="<?php if (count($stockReturnLists) >10) {
                                    echo "dataTable"; } ?>" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th>Return Id</th>
                                            <th>Distributor</th>
                                            <th>Return Date</th>
                                            <th>Entry Date</th>
                                            <th>Entry By</th>
                                            <th>Payment Mode</th>
                                            <th>Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-data">
                                        <?php
                                            foreach ($stockReturnLists as $row) {
                                                $dist = $Distributor->showDistributorById($row['distributor_id']);
                                               // print_r($dist);
                                                
                                                if (count($dist) > 0) {
                                                    
                                                    $returnDate = date("d-m-Y", strtotime($row['return_date']));
                                                    $entryDate  = date("d-m-Y", strtotime($row['added_on']));

                                                    $check ='';
                                                    if ($row['status'] == "cancelled") {
                                                         $check  = 'style="background-color:#ff0000; color:#fff"';
                                                    }
                                                    echo '<tr '.$check.'>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')" >'.$row['id'].'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$dist[0]['name'].'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$returnDate.'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$entryDate.'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$row['added_by'].'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$row['refund_mode'].'</td>
                                                        <td data-toggle="modal" data-target="#viewReturnModal" onclick="viewReturnItems('.$row['id'].')">'.$row['refund_amount'].'</td>
                                                        <td >
                                                            <a href="stock-return-edit.php?returnId='.$row['id'].'" class="text-primary ml-4"><i class="fas fa-edit"></i></a>
                                                            <a class="text-danger ml-2" onclick="cancelPurchaseReturn('.$row['id'].', this)" ><i class="fas fa-window-close"></i></a>
                                                        </td>
                                                    </tr>';
                                                }else{
                                                    echo '<tr><td>No Matching Data Found</td></tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!--=========================== Show Bill Items ===========================-->


                </div>
                <!-- /.container-fluid -->
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

             <!-- Footer -->
             <?php include_once 'partials/footer-text.php'; ?>
            <!-- End of Footer -->

            <!-- Return View Modal" -->
            <div class="modal fade" id="viewReturnModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Return Items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="viewReturnModalBody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <?php require_once '_config/logoutModal.php'; ?>
        <!--End of Logout Modal-->

        <script>
        const returnFilter = (t) => {
            let table = t.id;
            let data = t.value;

            var xmlhttp = new XMLHttpRequest();

            // ============== Check Existence ==============
            filterUrl = `ajax/return.filter.ajax.php?table=${table}&value=${data}`;
            // alert(url);
            xmlhttp.open("GET", filterUrl, false);
            xmlhttp.send(null);
            document.getElementById("filter-table").innerHTML = xmlhttp.responseText;

        }
        </script>

        <!-- Bootstrap core JavaScript-->
        <script src="../assets/jquery/jquery.min.js"></script>
        <script src="../js/bootstrap-js-4/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="vendor/product-table/jquery.dataTables.js"></script>
        <script src="vendor/product-table/dataTables.bootstrap4.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../assets/jquery-easing/jquery.easing.min.js"></script>


        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <script>
        const viewReturnItems = (returnId) => {

            var xmlhttp = new XMLHttpRequest();

            // ============== Check Existence ==============
            idUrl = `ajax/return-item-list.ajax.php?return-id=${returnId}`;
            // alert(url);
            xmlhttp.open("GET", idUrl, false);
            xmlhttp.send(null);
            document.getElementById("viewReturnModalBody").innerHTML = xmlhttp.responseText;
            // alert(xmlhttp.responseText);
        }
        </script>

        <script>
        const cancelPurchaseReturn = (returnId, t) => {
            if (confirm("Are You Sure?")) {
                    // alert(t);

                    $.ajax({
                        url: "ajax/return.Cancel.ajax.php",
                        type: "POST",
                        data: {
                            id: returnId
                        },
                        success: function(data) {
                            // alert(data);
                            if (data == 1) {
                                $(t).closest("tr").css("background-color","#ff0000");
                                $(t).closest("tr").css("color","#fff");
                                
                            } else {
                                // $("#error-message").html("Deletion Field !!!").slideDown();
                                // $("success-message").slideUp();
                                alert("Cancelation Failed !");
                            }

                        }
                    });
                }
                return false;
        }


        </script>


</body>

</html>