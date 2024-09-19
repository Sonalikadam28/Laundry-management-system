<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { header('location:index.php');
}
else{
// Code for Add New Sub Admi
if(isset($_POST['submit'])){
$itemname=$_POST['itemname'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$query=mysqli_query($con,"insert into tblitem(itemname, qty, price) values('$itemname','$qty','$price')");
if($query){
echo "<script>alert('Item details added successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-items.php'; </script>";
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
  <title>APSOLUTION | Add Item</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
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
            <h1>Add Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Item</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fill the Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="subadmin" method="post">
                <div class="card-body">
<!-- Username-->
   
   <div class="form-group">
                    <label for="exampleInputFullname">Enter Item Name</label>
                    <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Enter Item Name" required>
                  </div>
<!-- Sub admin Email---->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Item Quantity" required>
                  </div>
<!-- Sub admin Contact Number---->
                  <div class="form-group">
                    <label for="text">Enter Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Contact Number" title="numeric characters only" required>
                  </div>
                  <!-- <div class="form-group">
                    <label for="text">Select Product Image</label>
                    <input type="file" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                  </div> -->

  
      
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
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
<script src="../../investor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../investor/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../investor/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../investor/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
