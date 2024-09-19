<?php 

session_start();
error_reporting(0);

// Database Connection
include('includes/config.php');

// Validating Session
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APSOLUTION | Manage Levels</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../investor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../investor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../investor/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
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
            <h1>Manage Levels</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Levels</li>
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
                <h3 class="card-title">Levels Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Level ID</th>
                    <th>Name</th>
                    <th>Commission (%)</th>
                    <th>Total Users	</th>
                    <th>Total Investment</th>
                    <!-- <th>Profits</th>
                    <th>Levels</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <!-- Sample Data -->
                    <tr>
            <td>1</td>
            <td>L001</td>
            <td>Level 1</td>
            <td>4%</td>
            <td>150</td>
            <td>$10,000</td>
            <!-- <td>$500</td>
            <td>5</td> -->
              <td>
                  <a href="#" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true" ></i></a>  
                  <a href="#" class="btn btn-danger" title="Delete this Record" onclick="return confirm('Do you really want to delete this record?');">
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </a></td>
        </tr>
        <tr>
            <td>2</td>
            <td>L002</td>
            <td>Level 2</td>
            <td>2%</td>
            <td>100</td>
            <td>$20,000</td>
            <!-- <td>$1,000</td>
            <td>10</td> -->
              <td>
                  <a href="#" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true" ></i></a>  
                  <a href="#" class="btn btn-danger" title="Delete this Record" onclick="return confirm('Do you really want to delete this record?');">
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </a></td>
        </tr>
        <tr>
            <td>3</td>
            <td>L003</td>
            <td>Level 3</td>
            <td>1%</td>
            <td>50</td>
            <td>$30,000</td>
            <!-- <td>$2,250</td>
            <td>15</td> -->
              <td>
                  <a href="#" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true" ></i></a>  
                  <a href="#" class="btn btn-danger" title="Delete this Record" onclick="return confirm('Do you really want to delete this record?');">
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </a></td>
        </tr>
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
<script src="../../investor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../investor/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../investor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../investor/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../investor/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../investor/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../investor/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../investor/plugins/jszip/jszip.min.js"></script>
<script src="../../investor/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../investor/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../investor/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../investor/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../investor/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../investor/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../investor/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>



