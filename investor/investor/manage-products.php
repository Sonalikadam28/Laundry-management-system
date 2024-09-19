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
  if(isset($_GET['id'])){
    $p_id = $_GET['id'];
    $query=mysqli_query($con,"delete from tblproducts where id = '$p_id'");
    if($query){
    echo "<script>alert('Products Record Deleted Successfully.');</script>";
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
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
  <title>AgroLink | Manage Products</title>

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
            <h1>Manage Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              
              <li class="breadcrumb-item"><a href="add-product.php">Add Products</a></li>
              <li class="breadcrumb-item active">Manage Products</li>
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
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Product Image</th>  
                    <th>Address</th>
                    <th>Location</th>
                    <th>Reg Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"SELECT p.*,p.id AS p_id, l.location_name AS l_name
                             FROM tblproducts p
                             JOIN tblfarmer f ON p.addedbyno = f.id
                             JOIN tbllocations l ON p.location_id = l.id 
                             WHERE addedbyno = ".$_SESSION['aid']);
$cnt=1;
while($row=mysqli_fetch_array($query)):
  $p_id = $row['p_id'];
  $name = $row['name'];
  $qty = $row['quantity'];
  $price = $row['price'];
  $image_path = $row['image'];
  $address = $row['address'];
  $location_name = $row['l_name'];
  $addedby = $row['addedby'];
  $regdate = $row['regdate'];
?>

                  <tr>
                    <td><?php echo $cnt++;?>.</td>
                    <td><?php echo ucwords($name); ?></td>
                    <td><?php echo $qty; ?> Kg</td>
                    <td><?php echo $price; ?></td>
                   <td><img src="../../uploads/<?php echo $image_path; ?>" alt="" srcset="" width="100"></td>
                   <td><?php echo $address; ?></td>
                    <td><?php echo ucwords($location_name); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($regdate)); ?></td>
                    <td class="">
    <a href="manage-products.php?id=<?php echo $p_id; ?>" title="Delete this Record" onclick="return confirm('Do you really want to delete this record?');">
        <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i>
    </a>
</td>

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