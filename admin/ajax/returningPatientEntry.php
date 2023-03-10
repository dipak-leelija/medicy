<?php
require_once '../sessionCheck.php';//check admin loggedin or not

require_once '../../php_control/hospital.class.php';
require_once '../../php_control/appoinments.class.php';
require_once '../../php_control/patients.class.php';


//Intilizing Classes
$hospital = new HelthCare();
$Patients = new Patients();


// Fetching Hospital Info
$hospitalDetails = $hospital->showhelthCare();
foreach($hospitalDetails as $showShowHospital){
    $hospitalName = $showShowHospital['hospital_name'];
}

    //Creating Object of Appointments Class
$appointments = new Appointments();

    if (isset($_POST['submit'])) {
    $appointmentDate        = $_POST["appointmentDate"];
    $patientName            = $_POST["patientName"];
    $patientGurdianName     = $_POST["patientGurdianName"];
    $patientEmail           = $_POST["patientEmail"];
    $patientPhoneNumber     = $_POST["patientPhoneNumber"];
    $patientAge             = $_POST["patientAge"];
    $patientWeight          = $_POST["patientWeight"];
    $gender                 = $_POST["gender"];
    $patientAddress1        = $_POST["patientAddress1"];
    $patientAddress2        = $_POST["patientAddress2"];
    $patientPS              = $_POST["patientPS"];
    $patientDist            = $_POST["patientDist"];
    $patientPIN             = $_POST["patientPIN"];
    $patientState           = $_POST["patientState"];
    $patientDoctor          = $_POST["patientDoctor"];

    
    $healthCareNameTrimed = strtoupper(substr($hospitalName, 0, 2));//first 2 leter oh healthcare center name
    $appointmentDateForId = str_replace("-", "", $appointmentDate);//removing hyphen from appointment date
    $randCode = rand(1000, 9999);//generating random number


    // Appointment ID Generated
    $appointmentId = $healthCareNameTrimed.''.$appointmentDateForId.''.$randCode ;
    
    // Inserting Appointments into DB
    $addAppointment = $appointments->addFromInternal($appointmentId, $appointmentDate, $patientName, $patientGurdianName, $patientEmail, $patientPhoneNumber, $patientAge, $patientWeight, $gender, $patientAddress1, $patientAddress2, $patientPS, $patientDist, $patientPIN, $patientState, $patientDoctor);


    // Inserting Patients Details into DB
    $addPatients = $Patients->addPatients( $patientName, $patientEmail, $patientPhoneNumber, $patientAge, $gender, $patientAddress1, $patientAddress2, $patientPS, $patientDist, $patientPIN, $patientState);
    if (!$addPatients) {
        echo "<script>alert('Patient Not Inserted, Something is Wrong!');</script>";
    }
    
    //redirect if the insertion has done
    if ($addAppointment) {
        echo '<script>alert(Appointment Added!)</script>';
        setcookie("appointmentId", $appointmentId, time() + (120 * 30), "/");
        header("location: ../appointment-sucess.php");
        exit();
    }else{
      echo "Something is wrong! ";
    }
}
      ?>