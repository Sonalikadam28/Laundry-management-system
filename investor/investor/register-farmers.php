<?php //error_reporting(0);
include('includes/config.php');
include_once('../../mailSender.php');
if(isset($_POST['submit'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $location_id = $_POST['city'];
  $mobile = $_POST['mobileno'];
  $currentpassword = $_POST['newpassword'];
  $newpassword = md5($_POST['newpassword']);

  $check_query = "SELECT * FROM tblfarmer WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email already exists. Please use a different email address.');</script>";
    } else {
      // Insert new farmer data into the tblfarmer table
      $insert_query = "INSERT INTO tblfarmer (fullname, email, mobno,address, location_id, password) VALUES ('$fullname', '$email', '$mobile', '$address', $location_id, '$newpassword')";
      $insert_result = mysqli_query($con, $insert_query);
      
      if($insert_result) {
        $subject = 'Farmer Registration Successful';
$msg = '<html>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);">
        <a href="https://postimages.org/" target="_blank"><img src="https://i.postimg.cc/x1j500Hj/agrolink.png" border="0" alt="AgroLink" style="display: block; margin: 0 auto; max-width: 200px; margin-bottom: 20px;"/></a>
            <h2 style="text-align: center; color: #555;">Farmer Registration Successful</h2>
            <p style="font-size: 16px; line-height: 1.6">Dear '.ucwords($fullname).',</p>
            <p style="font-size: 16px; line-height: 1.6;">We are pleased to inform you that your registration as a Farmer Seller has been Successful.</p>
            <p style="font-size: 16px; line-height: 1.6;">Below are your login credentials:</p>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 10px; border: 1px solid #555; font-weight: bold;">Username (Email):</td>
                    <td style="padding: 10px; border: 1px solid #555;">'.$email.'</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #555; font-weight: bold;">Password:</td>
                    <td style="padding: 10px; border: 1px solid #555;">'.$currentpassword.'</td>
                </tr>
            </table>
            <p style="font-size: 16px; line-height: 1.6;">Please use the provided credentials to log in and access your account. If you have any questions or concerns, feel free to contact us.</p>
            <p style="font-size: 16px; line-height: 1;">Best regards,</p>
            <p style="font-size: 16px; line-height: 1; color: blue"><b>THE AGROLINK TEAM</b></p>
        </div>
    </body>
</html>';

	
        $accept = smtp_mailer($email, $subject, $msg);

        if($accept) {
          echo "<script>alert('Farmer Registered Successfully');</script>";
          echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
      } else {
          echo "<script>alert('Failed to send email notification');</script>";
      }
  } else {
      echo "<script>alert('Failed to Register Farmer');</script>";
  }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | Farmer Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
<script type="text/javascript">
function valid()
{
if(document.passwordrecovery.newpassword.value!= document.passwordrecovery.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.passwordrecovery.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index.php" class="h4"><b>Farmer Register</b> | AGROLINK</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register in to start your session</p>

      <form name="register-farmers" method="post" onSubmit="return valid();">
      <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="First Full Name" name="fullname"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email Id" name="email"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
  <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Mobile Number" name="mobileno"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter Address" name="address"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        
        <div class="input-group mb-3">
    <select style=" cursor: pointer;" name="city" id="city" class="form-control demo-default" required>
        <?php 
        $sql = "SELECT * FROM `tbllocations`;";
        $result = $con->query($sql);
        foreach ($result as $r) {
        ?>
        <option value="<?php echo $r['id']; ?>"><?php echo $r['location_name']; ?></option>
        <?php } ?>
    </select>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-city"></span>
        </div>
    </div>
</div>


        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="newpassword" id="newpassword"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


  <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <a href="../../index.php" class="btn btn-danger btn-block" >Back to Home</a>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block" name="submit">Register Here</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="index.php">Signin</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
