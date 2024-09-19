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
//Code For Deletion the subadmin

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | View Locations</title>

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
            <h1>View Locations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View City List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-7">
            <div class="card">
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Location Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Location Id</th>
                    <th>Location Name</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select * from tbllocations");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td ><?php echo $cnt;?>.</td>
                    
                    <td><?php echo $result['id'];?></td>
                    <td><?php echo $result['location_name']; $cnt++;?></td>
                  
                  </tr>
         <?php } ?>
             
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
      "buttons": [ "csv", "excel", "pdf"]
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