<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | Buyer Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../investor/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
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
      <a href="../../index.php" class="h4"><b>Buyer Register</b> | AGROLINK</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register in to start your session</p>

      <form name="register-buyer" method="post" onSubmit="return valid();">
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
    <option value="" disabled selected>Select a City</option>
        
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
<script src="../../investor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../investor/dist/js/adminlte.min.js"></script>
</body>
</html>
