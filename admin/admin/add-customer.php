<?php
session_start();
include('includes/config.php');
require '../../assets/barcode/vendor/autoload.php';

if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    
}else{
   
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APSOLUTION | Add Customer</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        .update-cart-form {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .update-cart-form:hover {
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }
        .item-name h5 {
            font-size: 1.25rem;
            color: #343a40;
            margin: 0;
        }
        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }
        .quantity-input {
            width: 60px;
            padding: 5px;
            font-size: 1rem;
            border-radius: 5px;
        }
        .mx-2 {
            margin: 0 10px;
        }
        .shadow-sm {
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        }
        .rounded {
            border-radius: 10px;
        }
        .quantity-wrapper {
         display: flex;
         justify-content: center;
         align-items: center;
         max-width: 150px;
         margin: 0 auto; /* Center horizontally */
     }
     
     .quantity-wrapper .btn {
         width: 40px;
         height: 40px;
         font-size: 20px;
         padding: 0;
         display: flex;
         justify-content: center;
         align-items: center;
     }
     
     .quantity-wrapper .form-control {
         max-width: 70px;
         height: 40px;
         font-size: 16px;
         text-align: center;
         padding: 0;
         margin: 0;
         border-radius: 0; /* Remove rounded corners */
         box-shadow: none; /* Remove input shadow */
     }
     
     .quantity-wrapper .btn-minus, 
     .quantity-wrapper .btn-plus {
         border-radius: 0; /* Square the buttons */
         border: 1px solid #ced4da; /* Match input field border */
         background-color: #f8f9fa;
         transition: background-color 0.2s;
     }
     
     .quantity-wrapper .btn-minus:hover, 
     .quantity-wrapper .btn-plus:hover {
         background-color: #e2e6ea;
     }
     
     .quantity-wrapper .btn-minus:focus, 
     .quantity-wrapper .btn-plus:focus {
         box-shadow: none; /* Remove focus outline */
     }
     
     .quantity-wrapper .btn:active {
         background-color: #dae0e5; /* Darker background on click */
     }

    </style>
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
                        <h1>New Customer Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Customer</li>
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
                    <div class="col-md-7">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Fill the Info</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="generateForm" action="generate_barcode.php" method="post">
                                <div class="card-body">
                                    <h6>Customer Details<hr/></h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fullname">Enter Full Name</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Customer Full Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mobilenumber">Enter Mobile Number</label>
                                                <input type="number" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter Contact Number" pattern="[0-9]{10}" title="10 numeric characters only" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Enter Address</label>
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Order Details<hr/></h6>
                                    <div class="row">
                                        <?php 
                                        // Fetch items from tblitem
                                        $query = mysqli_query($con, "SELECT * FROM `tblitem`");
                                        
                                        // Loop through each fetched item
                                        while ($item = mysqli_fetch_assoc($query)) { 
                                        ?>
                                        <div class="col-md-3">
                                            <div class=" ">
                                            <input type="hidden" name="items[<?php echo $item['id']; ?>]" value="0">
                                                <input type="hidden" name="itemId[]" value="<?php echo $item['id']; ?>">
                                                
                                                <!-- Display Item Name -->
                                                <div class="item-name mb-2">
                                                    <strong><?php echo ucwords($item['itemname']); ?></strong>
                                                </div>
                                                
                                                <div class="input-group quantity-wrapper">
                                                    <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                                                    <input type="number" min="0" value="0" class="form-control quantity-input text-center" name="quantity[]" data-item-id="<?php echo $item['id']; ?>">
                                                    <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                                </div>

                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <button type="button" class="btn btn-success mt-3" onclick="generateBarcode()">Preview</button>
                                    <!-- <input type="button" value="Preview" class="btn btn-success mt-3"> -->
                                    <!-- <button type="submit" class="btn btn-primary mt-3" name="submit" id="submit">Generate QR</button> -->
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                  <div class="col-md-5">  <div id="resultContainer" class=""></div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../investor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../investor/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-minus').click(function() {
            var $input = $(this).siblings('.quantity-input');
            var currentVal = parseInt($input.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $input.val(currentVal - 1);
            }
        });

        $('.btn-plus').click(function() {
            var $input = $(this).siblings('.quantity-input');
            var currentVal = parseInt($input.val());
            if (!isNaN(currentVal)) {
                $input.val(currentVal + 1);
            }
        });
    });
 
 
    function generateBarcode() {
        var formData = new FormData(document.getElementById('generateForm'));

        $.ajax({
            url: 'generate_barcode.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#resultContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>
</body>
</html>
<?php }?>