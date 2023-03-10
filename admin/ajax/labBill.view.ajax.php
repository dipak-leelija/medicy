<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../php_control/labBilling.class.php';
require_once '../../php_control/labBillDetails.class.php';
require_once '../../php_control/sub-test.class.php';
require_once '../../php_control/patients.class.php';
require_once '../../php_control/doctors.class.php';




$billId = $_GET['billId'];

$LabBilling     = new LabBilling();
$LabBillDetails = new LabBillDetails();
$SubTests       = new SubTests();
$Patients       = new Patients();
$Doctors         = new Doctors();



$labBil      = $LabBilling->labBillDisplayById($billId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body{
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>

</head>

<body class="mx-2">

    <table class="table table-striped">
        <?php
            foreach ($labBil as $rowlabBil) {
            
                $billId         = $rowlabBil['bill_id'];
                $billDate       = $rowlabBil['bill_date'];
                $patientId      = $rowlabBil['patient_id'];
                $docId          = $rowlabBil['refered_doctor'];
                $testDate       = $rowlabBil['test_date'];
                $totalAmount    = $rowlabBil['total_amount'];
                $totalDiscount  = $rowlabBil['discount'];
                $afterDiscount  = $rowlabBil['total_after_discount'];
                $cgst           = $rowlabBil['cgst'];
                $sgst           = $rowlabBil['sgst'];
                $paidAmount     = $rowlabBil['paid_amount'];
                $dueAmount      = $rowlabBil['due_amount'];
                $status         = $rowlabBil['status'];
                $addedBy        = $rowlabBil['added_by'];
                $BillOn         = $rowlabBil['added_on'];



            }

            $patient = $Patients->patientsDisplayByPId($patientId);
            foreach ($patient as $rowPatient) {
                $patientName = $rowPatient['name'];
                $patientPhno = $rowPatient['phno'];
                $patientAge  = $rowPatient['age'];
                $patientGender = $rowPatient['gender'];

            }


            if (is_numeric($docId)) {
                $showDoctor = $Doctors->showDoctorById($docId);
                foreach ($showDoctor as $rowDoctor) {
                    $doctorName = $rowDoctor['doctor_name'];
                }
            }else {
                $doctorName = $docId;
            }
        ?>
        <div class="row mb-4">
            <div class="col-sm-4">
                <h6><b>Patient Name:</b> <?php echo $patientName; ?></h6>
                <h6><b>Patient Contact:</b> <?php echo $patientPhno; ?></h6>
            </div>
            <div class="col-sm-4">
                <h6><b>Refered By:</b> <?php echo $doctorName; ?></h6>
                <h6><b>Test Date:</b> <?php echo $testDate; ?></h6>

            </div>
            <div class="col-sm-4">
                <div class="d-flex justify-content-between"">

                <h6><b>Bill ID:</b> <?php echo $billId; ?></h6>
                <base target="_parent">
                <?php
                    if ($status != "Cancelled") {
                        echo '<h6><a class="btn btn-sm btn-primary" href="../edit-lab-billing.php?invoice=<?php echo $billId; ?>">Edit</a></h6>';
                    }else{
                        echo '<h6 class="border border-danger text-danger p-1"> Bill Cancelled</h6>';
                    }
                ?>
                <!-- <form action="../edit-lab-billing.php">
                    <button type="submit">Edit</button>
                </form> -->

                </div>

                <h6><b>Bill Date:</b> <?php echo $billDate; ?></h6>
            </div>

        </div>

        <thead>
            <tr>
                <th scope="col">SL. NO</th>
                <th scope="col">Test Name</th>
                <th scope="col">Test Price</th>
                <th scope="col">Disc(%)</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $slno = 0;
            $billDetails = $LabBillDetails->billDetailsById($billId);
            foreach ($billDetails as $rowbillDetails) {
                $slno += 1;
                // $rowbillDetails['id'];
                $billId     = $rowbillDetails['bill_id'];
                // $rowbillDetails['billing_date'];
                // $rowbillDetails['test_date'];
                $subTestId     = $rowbillDetails['test_id'];
                $testPrice  = $rowbillDetails['test_price'];
                $discOnTest = $rowbillDetails['percentage_of_discount_on_test'];
                $amount     = $rowbillDetails['price_after_discount'];
                // $rowbillDetails['added_by'];
                // $rowbillDetails['added_on'];

                $subTest = $SubTests->showSubTestsId($subTestId);
                foreach ($subTest as $rowsubTest) {
                    $testName = $rowsubTest['sub_test_name'];
                }


            
                echo '<tr>
                        <th scope="row">'.$slno.'</th>
                        <td>'.$testName.'</td>
                        <td>'.$testPrice.'</td>
                        <td>'.$discOnTest.'</td>
                        <td>'.$amount.'</td>
                      </tr>';
            }
            ?>
        </tbody>
    </table>



    <!-- <div class="my-6"></div> -->

    <table class="table mt-5 mb-0 pb-0">
        <thead class="thead-dark mb-0 pb-0">
            <tr>
                <?php
                echo '
                <th scope="col">Sub Total: '.$totalAmount.'</th>
                <th scope="col">Disc(???): '.$totalDiscount.'</th>
                <th scope="col">After Disc(???): '.$afterDiscount.'</th>
                <th scope="col">Due: '.$dueAmount.'</th>
                <th scope="col">Paid: '.$paidAmount.'</th>';
                ?>
            </tr>
        </thead>
    </table>

<!-- <script src="../../js/iframe-resize/iframeResizer.contentWindow.min.js"></script> -->

</body>

</html>