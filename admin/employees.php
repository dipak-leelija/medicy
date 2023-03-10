<?php
require_once 'sessionCheck.php';//check admin loggedin or not

require_once '../php_control/employee.class.php';
$employees = new Employees();
$showEmployees = $employees->employeesDisplay();

$page = "employees";

//Employee Class Initilzed
// $employees = new Employees();

if(isset($_POST['add-emp']) == true){
    

    $empName = $_POST['emp-name'];
    $empUsername = $_POST['emp-username'];
    $empMail = $_POST['emp-mail'];
    $empRole = $_POST['emp-role'];
    $empPass = $_POST['emp-pass'];
    $empCPass = $_POST['emp-cpass'];
    $empAddress = $_POST['emp-address'];

    // echo 'Pass1'.$empPass.',and Pass2'.$empCPass;
    // exit;
    
    if ($empPass == $empCPass) {
        $wrongPasword = false;
        $empPass = password_hash($empPass, PASSWORD_DEFAULT);
        
        // echo 'Password is'.$empPass;
        // exit;
        //addEmp Function initilized to add employees
        $addEmployee = $employees->addEmp($empUsername, $empName, $empRole, $empMail, $empAddress, $empPass);

            if($addEmployee){
                echo "<script>alert('Employee Addeded!')</script>";
            }else{
                echo "<script>alert('Employee Insertion Failed!')</script>";
            }
    }else {
        echo "<script>alert('Password Did Not Matched!')</script>";
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

    <title>Medicy Employees</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom/employees.css">
    <style>
        #toggle{
            /* position: absolutte;
            top: 25%;
            left: 200px; */
            position: relative;
            float: right;
            transform: translateY(-115%);
            width: 30px;
            height: 30px;
            background: url(img/hide-password.png) ;
            /* background-color: black; */
            background-size: cover;
            cursor: pointer;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- end sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Employees</h1>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        //employeesDisplay function initilized to feth employees data
                                        $showEmployees = $employees->employeesDisplay();
                                        foreach($showEmployees as $emp){
                                            $empId = $emp['id'];
                                            $empUsername = $emp['employee_username'];
                                            $empName = $emp['employee_name'];
                                            $empRole = $emp['emp_role'];
                                            $empMail = $emp['emp_email'];
                                            // $emp['employee_password'];
                                            // $emp[''];

                                            echo'<tr>
                                                    <td>'.$empId.'</td>
                                                    <td>'.$empUsername.'</td>
                                                    <td>'.$empName.'</td>
                                                    <td>'.$empRole.'</td>
                                                    <td>'.$empMail.'</td>
                                                    <td>2011/04/25</td>
                                                    <td>
                                                        <a class="text-primary" onclick="viewAndEdit('.$empId.')" title="Edit" data-toggle="modal" data-target="#empViewAndEditModal"><i class="fas fa-edit"></i></a>

                                                        <a class="delete-btn" data-id="'.$empId.'"  title="Delete"><i class="far fa-trash-alt"></i></a>
  
  
                                                    </td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <!--Entry Section-->
                <div class="col" style="margin: 0 auto; width:98%;">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Employee</h6>
                        </div>
                        <div class="card-body">
                            <form action="employees.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-name"> Employee Name:</label>
                                            <input class="form-control" type="text" name="emp-name" id="emp-name" maxlength="30" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-username">Employee Username:</label>
                                            <input class="form-control" type="text" name="emp-username" id="emp-username" maxlength="12" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-mail">Employee Mail:</label>
                                            <input class="form-control" type="email" name="emp-mail" id="emp-mail" maxlength="100" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-role">Employee Role:</label>
                                            <input class="form-control" type="text" name="emp-role" id="emp-role" maxlength="100" required>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        

                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-address">Full Address:</label>
                                            <textarea class="form-control" name="emp-address" id="emp-address" cols="30"
                                                rows="4" maxlength="255"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-pass">Password:</label>
                                            <input class="form-control" type="password" name="emp-pass" id="emp-pass" maxlength="12" required>
                                            <div id="toggle" onclick="showHide();"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0 mt-1" for="emp-pass">Confirm Password:</label>
                                            <input class="form-control" type="password" name="emp-cpass" id="emp-pass" maxlength="12" required>
                                            <div id="toggle" onclick="showHide();"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 me-md-2">
                                    <button class="btn btn-success me-md-2" type="submit" name="add-emp">Add Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Entry Section-->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer-text.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Emp Edit and View Modal -->
    <div class="modal fade" id="empViewAndEditModal" tabindex="-1" role="dialog" aria-labelledby="empViewAndEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="empViewAndEditModalLabel">Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body viewnedit">
                    <!-- MODAL CONTENT GOES HERE BY AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="refreshPage()">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Emp Edit and View Modal End -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Javascript -->
    <script src="js/custom-js.js"></script>
    <script>
    viewAndEdit = (empId) => {
        let employeeId = empId;
        let url = "ajax/emp.view.ajax.php?employeeId=" + employeeId;
        $(".viewnedit").html('<iframe width="99%" height="440px" frameborder="0" allowtransparency="true" src="' +
            url + '"></iframe>');
    } // end of viewAndEdit function
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="../js/bootstrap-js-4/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

   
 <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-btn", function() {

                if (confirm("Are you want delete data?")) {
                    empId = $(this).data("id");
                    //echo $empDelete.$this->conn->error;exit;

                    btn = this;
                    //alert(btn);

                    $.ajax({
                        url: "ajax/employee.Delete.ajax.php",
                        type: "POST",
                        data: {
                            id: empId
                           // alert(empId);
                        },
                    
                        success: function(data) {
                           
                            if (data == 1) {
                                $(btn).closest("tr").fadeOut()
                            } else {
                                $("#error-message").html("Deletion Field !!!").slideDown();
                                $("success-message").slideUp();
                            }

                        }
                    });
                }
                return false;

            })

        })
        </script>
        <script>
            const password = document.getElementById('emp-pass');
            const toggle = document.getElementById('toggle');

            function showHide(){
                if (password.type === 'password') {
                    password.setAttribute('type','text');
                    toggle.classList.add('hide');
                }else{
                    password.setAttribute('type','password');
                    toggle.classList.remove('hide');
                }
            }

        </script>


</body>

</html>