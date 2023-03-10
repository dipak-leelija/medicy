 <?php
// // echo "PHP Test Line";

$showError = false;

// $insart = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';

    $username= $_POST["username"];
    $password= $_POST["password"];
 
    $sql = "SELECT * from employees where employee_username = '$username'";
      $result = mysqli_query($conn, $sql);
      $rowNum = mysqli_num_rows($result);

      if ($rowNum ==1) {
        while($row= mysqli_fetch_assoc($result)){
              if ( password_verify($password, $row['employee_password'])) {
                //   $login = true; 
                if ($row['emp_role'] == "Pharmacist") {
                  session_start();
                  $_SESSION['loggedin']= true;
                  $_SESSION['pharmacist'] = true; 
                  $_SESSION['employee_username'] = $username;
                 $redirectLink = $_SESSION['pharmacy_section'];
                  // exit;
                if ($redirectLink == '') {
                    // header("Location: index.php");
                    header("location: ../../pharmacist");
                }
                else {
                    // echo $redirectLink;
                    // exit;
                    header("Location: ".$redirectLink."");

                }
                exit;
                }else {
                  // echo $row['emp_role'];
                  // exit;
                  session_start();
                  $_SESSION['loggedin']= true;
                  $_SESSION['employee'] = true; 
                  $_SESSION['employee_username'] = $username;
                //   echo $_SESSION['employee_username'];
                //   exit;
                $redirectLink = $_SESSION['emplooyee_sec'];
                if ($redirectLink == '') {
                    header("Location: index.php");
                }
                else {
                    // echo $redirectLink;
                    // exit;
                    header("Location: ".$redirectLink."");
                }
                exit;
                  // header("location: ../index.php");
                }
                  
              }
              else{
                  $showError = "Invalid Password!";
              }
        }   
      }
      else{
          $showError = "Invalid Username!";
      }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../css/bootstrap 5/bootstrap.css">
    <!-- <script src="../require/js/bootstrap.js"></script> -->

    <title>Employee Login</title>
    </head>
    <body>

        <div class="container mt-5">
                <h2 class="text-center py-5">Employee Login</h2>  
            <form action="login.php" method="post" style="flex-direction: column; display: flex; align-items: center;">
            <?php
            if ($showError) {
            echo '<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Sorry!</strong> '.$showError.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            </div>';
            }
            ?> 
            <div class="row">
            <div class="mb-3 col-md-12">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="15" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="8" class="form-control" id="password" name="password">
                <small id="password" class="form-text text-muted mt-0">Maximum Username and Password Length Should be 12</small>
            </div>
            </div>

            <button type="submit" class="btn btn-primary col-md-6">Login</button>
            </form>
        </div>
    </body>
</html>
