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

  if($_GET['action']=='accept'){
    $order_id=intval($_GET['o_id']);
    $query=mysqli_query($con,"update buyproductrequest set status = 1 WHERE id ='$order_id'");
    if($query){
    echo "<script>alert('New Product Order Request Accepted Successfully.');</script>";
    echo "<script type='text/javascript'> document.location = 'viewbuyproductorder.php'; </script>";
    } else {
    echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
    
    }


    if($_GET['action']=='reject'){
      $order_id=intval($_GET['o_id']);
      $query=mysqli_query($con,"update buyproductrequest set status = 2 WHERE id ='$order_id'");
      if($query){
      echo "<script>alert('New Product Order Request Rejected Successfully.');</script>";
      echo "<script type='text/javascript'> document.location = 'viewbuyproductorder.php'; </script>";
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
  <title>AgroLink | View Product Orders</title>
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
            <h1>View Product Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Product Order</li>
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
                <h3 class="card-title">Product Orders Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                    <th>Order Id</th>
                    <th>Invoice Id</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Amt</th>
                    <th>Buyer</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select b.*, t.*, t.fullname AS buyer_name, t.mobno AS t_mobno, b.id AS buyproductrequest_id from buyproductrequest b JOIN tblbuyer t ON b.buyer_id = t.id WHERE b.seller_id = '".$_SESSION['aid']."'");
$cnt=1;
while($row=mysqli_fetch_array($query)):
  $transaction_id = $row['transaction_id'];
  $invoice_id = $row['invoice_id'];
  $buyproductrequest_id = $row['buyproductrequest_id'];
  $product_name = $row['product_name'];
  $product_quantity = $row['product_qty'];
  $product_price = $row['product_price'];
  $product_totalamt = $row['product_totalamt'];
  $buyer_name = $row['buyer_name'];
  $t_mobno = $row['t_mobno'];
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
                    <td><?php echo $invoice_id; ?></td>
                    <td><?php echo ucwords($product_name); ?></td>
                    <td><center><?php echo $product_quantity; ?> Kg</center></td>
                    
                    <td><center>Rs. <?php echo $product_price; ?></center></td>
                    <td><center>Rs. <?php echo $product_totalamt; ?></center></td>
                    <td><center><?php echo $buyer_name; ?></center></td>
                    <td><center><?php echo $t_mobno; ?></center></td>
                    <td style="color: <?php echo $status_color; ?>" ><center><b><?php echo $status_text;?></b></center></td>
                    <td style="color: <?php echo $status_color; ?>"><center><?php if($status_text == "Pending"){?><a href="viewbuyproductorder.php?action=accept&&o_id=<?php echo $buyproductrequest_id; ?>" class="btn btn-success btn-sm active" onclick="return confirm('Do you really want to Accept this record?');" >Accept</a><a href="viewbuyproductorder.php?action=reject&&o_id=<?php echo $buyproductrequest_id; ?>" class="btn btn-danger btn-sm active ml-2" onclick="return confirm('Do you really want to Reject this record?');">Reject</a><?php } else if($status_text == "Completed"){
                    ?><a href="invoice/view_invoice.php?id=<?php echo $transaction_id?>" class="btn btn-success btn-sm active">Invoice</a> <?php

                    } else{
                      echo '<b>' . $status_text . '</b>';
                    } ?></center></td>
                   
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