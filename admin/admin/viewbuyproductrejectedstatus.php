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
  <title>AgroLink | View Buy Product Status</title>
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
            <h1>View Rejected Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Rejected Orders</li>
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
                <h3 class="card-title">Bought Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                    <th>Order Id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Buyer Name</th>
                    <th>Seller Name</th>
                    <th>Contact No</th>
                    <th>Reg Date</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select b.*, f.*, f.fullname AS seller_name, f.mobno AS f_mobno, tb.fullname AS buyer_name from buyproductrequest b JOIN tblbuyer tb ON b.buyer_id = tb.id JOIN tblfarmer f ON b.seller_id = f.id WHERE STATUS = 2");
$cnt=1;
while($row=mysqli_fetch_array($query)):
  $transaction_id = $row['transaction_id'];
  $product_name = $row['product_name'];
  $product_quantity = $row['product_qty'];
  $product_totalamt = $row['product_totalamt'];
  $buyer_name = $row['buyer_name'];
  $seller_name = $row['seller_name'];
  $f_mobno = $row['f_mobno'];
  $formattedDate = date('j, F Y', strtotime($date));
  $status = $row['status'];
  $status_text = '';
  $status_color = '';

if ($status == 0) {
    $status_text = 'Pending';
    $status_color = 'orange'; // You can set any color you prefer
} elseif ($status == 1) {
    $status_text = 'Completed';
    $status_color = 'green'; // You can set any color you prefer
} else {
    $status_text = 'Rejected';
    $status_color = 'red'; // You can set any color you prefer
}

// If $dateFromDB is in another format or stored as a Unix timestamp
$dateObject = new DateTime($dateFromDB);
$formattedDate = $dateObject->format('j, F Y');
?>

                  <tr>
                    <td><?php echo $cnt++;?>.</td>
                    <td><?php echo $transaction_id; ?></td>
                 
                    <td><?php echo ucwords($product_name); ?></td>
                    <td><center><?php echo $product_quantity; ?> Kg</center></td>
                    <td><center>Rs. <?php echo $product_totalamt; ?></center></td>
                    
                    <td><center><?php echo $buyer_name; ?></center></td>
                    <td><center><?php echo $seller_name; ?></center></td>
                    <td><center><?php echo $f_mobno; ?></center></td>
                    <td><center><?php echo $formattedDate; ?></center></td>
                    <td style="color: <?php echo $status_color; ?>" ><center><b><?php echo $status_text;?></b></center></td>
                   
                  </tr>
         <?php  endwhile; ?>
             
                  </tbody>
                
                </table>
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
<!-- DataTables  & Plugins -->
<script src="../../farmer/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../farmer/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../farmer/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../farmer/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../farmer/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../farmer/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../farmer/plugins/jszip/jszip.min.js"></script>
<script src="../../farmer/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../farmer/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../farmer/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../farmer/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../farmer/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../farmer/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../farmer/dist/js/demo.js"></script>
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