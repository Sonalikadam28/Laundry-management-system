<?php
session_start();
include('includes/config.php');

if(isset($_POST['login']))
  {
    $uname=$_POST['username'];
    $Password=md5($_POST['inputpwd']);
    $query=mysqli_query($con,"select ID,AdminuserName,UserType, Email from tbladmin where  AdminuserName='$uname' && Password='$Password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['ID'];
      $_SESSION['uname'] = $ret['AdminuserName'];
      $_SESSION['utype'] = $ret['UserType'];
     header('location:dashboard.php');
    }
    else{
    echo "<script>alert('Invalid Details.');</script>";          
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APSOLUTION | Admin Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../investor/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index.php" class="h2"><b>Admin</b> | APSOLUTION</a>
    </div>
    <div class="card-body" style="padding-bottom: 0px">
      <p class="login-box-msg">Sign in to start your session</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="inputpwd"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
   
          </div>
          <!-- /.col -->
          <button type="submit" class="btn btn-primary btn-block mb-1" name="login">Sign In</button>
          <a href = "../../index.php" class="btn btn-success btn-block mb-2" >Back to Home</a>
          
          <!-- /.col -->
          <a href="password-recovery.php">I forgot my password</a>
        </div>
      </form>
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
