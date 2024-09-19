<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | View Products</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../farmer/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../farmer/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../farmer/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../farmer/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../farmer/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="display: inline;">Product Details</h3>
                <div class="float-right">
                    <label for="search" style="display: inline; margin-right: 10px;">Search Product</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by product name" style="width: 300px; display: inline;">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <?php 
                    $houses = mysqli_query($con,"SELECT p.*,p.id AS p_id, l.location_name AS l_name, f.mobno AS fmobno, f.fullname AS f_name
                    FROM tblproducts p
                    JOIN tblfarmer f ON p.addedbyno = f.id
                    JOIN tbllocations l ON p.location_id = l.id");

                    while ($row = $houses->fetch_assoc()): ?>
                    <div class="col-md-3 mx-4 my-2 product-item" data-product-name="<?php echo strtolower($row['name']); ?>">
                        <div class="card d-flex justify-content-left align-items-left" style="width: 20rem; height: 28rem; padding: 8px;">
                            <img src="../../uploads/<?php echo $row['image']; ?>" class="card-img-top flight-img" alt="..." style="width: 100%; height: 200px;">
                            <div class="card-body">
                                <h4 class="card-title"><b>Product: </b><?php echo $row['name']; ?></h5>
                                <p class="card-text">
                                    <b>Quantity: </b><?php echo $row['quantity']; ?> Kg<br>
                                    <b>Price: </b>Rs. <?php echo ucwords($row['price']); ?> per Kg<br>
                                    <b>Description: </b><?php echo ucwords($row['description']); ?><br>
                                    <b>Seller Name: </b><?php echo ucwords($row['f_name']); ?><br>
                                    <b>Contact No: </b>₹ <?php echo $row['fmobno']; ?><br>
                                    <b>Address:</b> <?php echo ucwords($row['address'] .", ".$row['l_name']); ?><br/>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../farmer/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../farmer/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../farmer/dist/js/adminlte.min.js"></script>
<!-- Custom script for search functionality -->
<script>
$(document).ready(function() {
  $('#searchInput').on('keyup', function() {
    var searchTerm = $(this).val().toLowerCase();
    $('.product-item').each(function() {
      var productName = $(this).data('product-name');
      if (productName.includes(searchTerm)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
</script>

</body>
</html>
<?php } ?>
