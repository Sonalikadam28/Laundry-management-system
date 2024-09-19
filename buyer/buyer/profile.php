<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
// Code for Update  Buyer Details
if(isset($_POST['update'])){
$fullname=$_POST['fullname'];
$mobileno=$_POST['mobilenumber'];
$address=$_POST['address'];
$adminid=intval($_SESSION['aid']);
$query=mysqli_query($con,"update tblbuyer set fullname='$fullname', mobno= '$mobileno', address = '$address' where id ='$adminid'");
if($query){
echo "<script>alert('Profile details updated successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | My Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../farmer/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../farmer/dist/css/adminlte.min.css">
  <!--Function Email Availabilty---->


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
$adminid=intval($_SESSION['aid']);
$query=mysqli_query($con,"select * from tblbuyer where  id='$adminid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update  the Info</h3>
              </div>

              <form name="subadmin" method="post">
                <div class="card-body">

              <div class="form-group">
               <label for="exampleInputusername">Email Id (used for login)</label>
               <input type="text"   name="sadminusername" id="sadminusername" class="form-control" value="<?php echo $result['email'];?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFullname">Enter Full Name</label>
                    <input type="text" class="form-control" id="fname" name="fullname" value="<?php echo $result['fullname'];?>" placeholder="Enter First Name" required>
                  </div>
                 
                  <div class="form-group">
                    <label for="text">Mobile Number </label>
                    <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter Mobile No"   value="<?php echo $result['mobno'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFullname">Enter Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $result['address'];?>" placeholder="Enter Address" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="text">Registration Date</label>
                    <input type="text" class="form-control" id="regdate" name="regdate"  required value="<?php echo $result['reg_date'];?>" readonly>
                  </div>


<?php } ?>
      
                  <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        
       
          </div>
          <!--/.col (left) -->
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../farmer/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../farmer/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../farmer/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../farmer/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../farmer/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
