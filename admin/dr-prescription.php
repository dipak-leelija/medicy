<?php

require_once '../php_control/appoinments.class.php';
require_once '../php_control/hospital.class.php';
require_once '../php_control/doctors.class.php';
require_once '../php_control/doctor.category.class.php';


$appointments = new Appointments();
$hospital = new HelthCare();
$doctors = new Doctors(); //Doctor Class 



// Fetching Appointments Info
$getDoctorForPatient = $_GET['prescription'];
// echo $appointmentId;exit;



// Fetching Hospital Info
$hospitalShow = $hospital->showhelthCare();
foreach($hospitalShow as $hospitalDetails){
    $hospitalName       = $hospitalDetails['hospital_name'];
    $address1           = $hospitalDetails['address_1'];
    $address2           = $hospitalDetails['address_2'];
    $city               = $hospitalDetails['city'];
    $pin                = $hospitalDetails['pin'];
    $state              = $hospitalDetails['health_care_state'];
    $hospitalEmail      = $hospitalDetails['hospital_email'];
    $hospitalPhno       = $hospitalDetails['hospital_phno'];
    $appointmentNumber  = $hospitalDetails['appointment_help_line'];
}

// Fetching Doctor Info
$selectDoctorByid = $doctors->showDoctorsForPatient($getDoctorForPatient);
// print_r($selectDoctorByid); exit;
foreach($selectDoctorByid as $DoctorByidDetails){
    $DoctorReg          = $DoctorByidDetails['doctor_reg_no'];
    $DoctorName         = $DoctorByidDetails['doctor_name'];
    $docSpecialization  = $DoctorByidDetails['doctor_specialization'];
    $DoctorDegree       = $DoctorByidDetails['doctor_degree'];
    $DoctorAlsoWith     = $DoctorByidDetails['also_with'];
    $DoctorAddress      = $DoctorByidDetails['doctor_address'];
    $DoctorEmail        = $DoctorByidDetails['doctor_email'];
    $DoctorPhno         = $DoctorByidDetails['doctor_phno'];
}

   // Fetching Appointments Info
   $DoctorCategory = new DoctorCategory();

    $showDoctorCategoryById = $DoctorCategory->showDoctorCategoryById($docSpecialization);
    foreach ($showDoctorCategoryById as $rowDocCatName) {
        $doctorName = $rowDocCatName['category_name'];
    }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap 5/bootstrap.css">
    <link rel="stylesheet" href="../css/prescription.css">
    <title>Prescription</title>
</head>

<body>
    <div style="box-shadow:none" class="card">
        <div class="hospitslDetails mb-0">
            <div class="row">
                <div class="col-1 headerHospitalLogo">
                    <img class="mt-4" src="../images/logo-p.jpg" alt="XYZ Hospital">
                </div>
                <div class="col-4 headerHospitalDetails">
                    <h1 class="text-primary text-start fw-bold mb-2 mt-4 me-3"><?php echo $hospitalName ?></h1>
                    <p class="text-start  me-3">
                        <small><?php echo $address1.', '.$address2.', '.$city.',<br>'.$state.', '.$pin; ?></small>
                    </p>
                </div>
                <div class="col-2 header-doc-img"> <img src="../images/medicy-doctor-logo.png" alt=""> </div>
                <div class=" text-danger col-5 headerDoctorDetails">
                    <h2 class="text-end mt-3  mb-0"><?php echo $DoctorName ?></h2>
                    <p class="text-end  mb-0 ">
                        <small><?php if($DoctorReg != NULL){ echo 'REG NO : '.$DoctorReg; } ?></small>
                    </p>

                    <p class="text-end  mb-0 ">
                        <small><?php echo $DoctorDegree.', '.$doctorName ?></small>
                    </p>
                    <p class="text-end  mb-0"> <?php echo $DoctorAlsoWith ?></p>
                    <!-- Member of: -->
                    <p class="text-end  mb-0"><?php // echo $DoctorAddress ?></p>
                    <h6 class="text-end text-primary"><strong>Call for Appointment:
                            <?php echo $appointmentNumber ?></strong></h6>
                </div>
            </div>

        </div>
        <hr class="mb-0 mt-0" style="color: #00f;">

        <div class="row space mt-1">
            <div class="col-3 border-end " style="border-color: #0000ff59 !important;">
                <div class="mt-2">
                    <h6><u> DIAGNOSIS </u></h6>
                    TC,DC,Hb%,ESR
                    <br>
                    BT,CT
                    <br>
                    BI,Sugar(F. & P.P)
                    <br>
                    GR. & Rh.type
                    <br>
                    VDRL
                    <br>
                    Lipid Profile
                    <br>
                    HIV-I & II
                    <br>
                    HBsAg
                    <br>
                    Urea
                    <br>
                    Creatine
                    <br>
                    TSH,T3,T4
                    <br>
                    Bilirubin
                    <br>
                    M.P.
                    <br>
                    L.F.T
                    <br>
                    Urine (RE/ME/CS)
                    <br>
                    Urine Pregnency
                    <br>
                    X-Ray Chest = PA
                    <br>
                    E.C.G
                    <br>
                    Serum PSA Titre
                    <br>
                    USG-W/A-L/A,FPP

                </div>
            </div>
            <div class="col-9">
                <div class="row mt-1">
                    <div class="col-12 d-flex justify-content-between border-bottom border-primary pb-2">
                        <p class="w-75 mb-0 mt-0 d-flex">
                            <span class="w-60"> Name : <?php  ?></span>
                            <span class="w-15 ms-3"> Age : <?php  ?> </span>
                            <span class="w-25 ms-3"> Sex : <?php  ?> </span>
                        </p>

                        <p class="mb-0 mt-0 text-end">
                            Date:
                            <?php
                            // $date=date_create($appointmentDate);
                            // echo date_format($date,"d-m-Y"); 
                            echo '22/12/2022';
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class=" footer ">
            <div class="row border border-primary pt-2 pb-0 d-flex justify-content-between">

                <div class="col-md-4 custom-width-name mb-0">
                    <ul style="margin-bottom: 8px">
                        <li class=" list-unstyled"><img id="healthcare-name-box" class="pe-2"
                                src="../employee/partials/hospital.png" alt="Healt Care"
                                style="width:28px; height:20px;" /><?php echo $hospitalName ?></li>
                    </ul>
                </div>

                <div class="col-md-4 custom-width-email mb-0">
                    <ul style="margin-bottom: 8px">
                        <li class="list-unstyled"><img id="email-box" class="pe-2"
                                src="../employee/partials/email-logo.png" alt="Email"
                                style="width:28px; height:20px;" /><?php echo $hospitalEmail ?></li>

                    </ul>
                </div>

                <div class="col-md-4 custom-width-number mb-0">
                    <ul style="margin-bottom: 8px">
                        <li class="list-unstyled"><img id="number-box" class="pe-2"
                                src="../employee/partials/call-logo.png" alt="Contact"
                                style="width:28px; height:20px;" /><span>
                                    <?php
                                    $separetor = ',';
                                    if ($hospitalPhno == null) {
                                        $separetor = '';
                                    } 
                                    echo $appointmentNumber.$separetor.' '.$hospitalPhno ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="text-center text-info"><strong>????????? ???????????? - ??????????????? ??????????????? ????????????????????? ????????????????????? ????????? ??????????????????????????? ???????????????????????????
                    ????????????????????? ???????????????</strong></p>
        </div>
        <!-- <div class="row">
        </div> -->
    </div>
    <div class="printButton mb-5">
        <button class="btn btn-primary" onclick="history.back()">Go Back</button>
        <button class="btn btn-primary" onclick="window.print()">Print Prescription</button>
    </div>
</body>

</html>