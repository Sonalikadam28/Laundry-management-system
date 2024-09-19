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
//Code For Deletion the classes
if($_GET['action']=='delete'){
$tid=intval($_GET['tid']);

$query=mysqli_query($con,"delete from tblrestables where id='$tid'");
if($query){
echo "<script>alert('Table details deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-tables.php'; </script>";
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
  <title>AgroLink | View Buyer Requirements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
            <h1>View Buyer Requirements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Buyer Requirements</li>
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
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Buyer Product Requirement Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    <div class="row">
        <?php 
        $houses = mysqli_query($con,"SELECT r.*,r.id AS r_id, l.location_name AS l_name, b.email AS buyer_email, b.mobno AS buyer_mobno
        FROM tblrequirements r
        JOIN tbllocations l ON r.location_id = l.id
        JOIN tblbuyer b ON r.addedbyno = b.id");

        while ($row = $houses->fetch_assoc()): ?>
        <div class="col-md-3 mx-4 my-2">
            <div class="card d-flex justify-content-left align-items-left" style=" padding: 8px;">
                <!-- <img src="../../" class="card-img-top flight-img" alt="..." style="width: 100%; height: 200px;"> -->
                <div class="card-body">
                    <h5 class="card-title"><b>Product Name: </b><?php echo $row['product_name']; ?></h5>
                    <p class="card-text" style="line-height: 1.8;">
    <b>Quantity: </b><?php echo $row['quantity']; ?> Kg<br>
    <b>Price: </b>Rs. <?php echo ucwords($row['price']); ?> Per Kg<br>
    <b>Total Amount: </b>Rs. <?php echo ucwords($row['total_amount']); ?><br>
    <b>Buyer Id: </b><?php echo ucwords($row['addedbyno']); ?><br>
    <b>Buyer Name: </b><?php echo ucwords($row['addedbybuyer_name']); ?><br>
    <b>Email Id: </b><?php echo ucwords($row['buyer_email']); ?><br>
    <b>Contact No: </b><?php echo ucwords($row['buyer_mobno']); ?><br>
    <b>Address: </b><?php echo ucwords($row['address'].", ".$row['l_name']); ?><br>
</p>
<a class="btn btn-primary" href="../chat/chat.php?user=<?php echo $row['addedbybuyer_name']; ?>">
        <i class="fas fa-comments"></i> Message
    </a>
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
<?php } ?>