<?php
session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
 
// Validating Session
if(strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit();
}
else {
// Code For Deleting the subadmin
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APSOLUTION | Generate Invoice</title>
 
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
    <?php include_once("includes/navbar.php"); ?>
    <!-- /.navbar -->
 
    <?php include_once("includes/sidebar.php"); ?>
 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Generate Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Generate Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
 
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Barcode Tracking Form -->
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Track Order by Barcode</h3>
                            </div>
                            <form id="barcode-form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="trackingId">Enter Barcode</label>
                                        <input type="text" class="form-control" id="trackingId" placeholder="Enter Barcode" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Track</button>
                                </div>
                            </form>
                        </div>
                    </div>
 
                    <!-- Display Results -->
                    <div class="col-md-6" id="result-section" style="display: none;">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <div class="card-body">
                                <h5>Customer Details</h5>
                                <p id="customer-details" class="text-muted"></p>
 
                                <h5>Items</h5>
                                <ul id="item-list" class="list-group"></ul>
 
                                <h5 class="mt-3">Grand Total </h5>
                                <p id="grand-total" class="text-success font-weight-bold"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
 
        <script src="../../investor/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables & Plugins -->
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
 
 
    </div>
    <!-- /.content-wrapper -->
 
 
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
 
<!-- Page specific script -->
 
<script>
document.getElementById('barcode-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting traditionally
 
    var barcode = document.getElementById('trackingId').value;
 
    // Send an AJAX request to fetch user details
    fetch('fetch_order_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'barcode=' + encodeURIComponent(barcode),
    })
    .then(response => response.text()) // Get the response as text
    .then(data => {
        console.log(data); // Log the response to check what you're getting
        // Now try to parse it as JSON
        try {
            const jsonData = JSON.parse(data);
            if (jsonData.success) {
                // Show the result section
                document.getElementById('result-section').style.display = 'block';
 
                // Update customer details
                document.getElementById('customer-details').textContent = jsonData.customerDetails;
 
                // Update items list
                let itemsHtml = '';
                jsonData.items.forEach(item => {
                    itemsHtml += `<li class="list-group-item">${item}</li>`;
                });
                document.getElementById('item-list').innerHTML = itemsHtml;
 
                // Update grand total
                document.getElementById('grand-total').textContent = `₹${jsonData.grandTotal}`;
            } else {
                document.getElementById('result-section').style.display = 'block';
                document.getElementById('customer-details').textContent = '';
                document.getElementById('item-list').innerHTML = '';
                document.getElementById('grand-total').textContent = '';
                document.getElementById('result-section').innerHTML = `<p>Error: ${jsonData.message}</p>`;
            }
        } catch (e) {
            console.error('JSON parsing error:', e);
            document.getElementById('result-section').style.display = 'block';
            document.getElementById('customer-details').textContent = '';
            document.getElementById('item-list').innerHTML = '';
            document.getElementById('grand-total').textContent = '';
            document.getElementById('result-section').innerHTML = '<p>An error occurred while fetching details.</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('result-section').style.display = 'block';
        document.getElementById('customer-details').textContent = '';
        document.getElementById('item-list').innerHTML = '';
        document.getElementById('grand-total').textContent = '';
        document.getElementById('result-section').innerHTML = '<p>An error occurred while fetching details.</p>';
    });
});
</script>
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