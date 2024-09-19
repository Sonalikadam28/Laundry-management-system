<?php 
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
} else {
  $buyproduct_id = $_POST['product_id'];
  // Code for Add New Product

  if(isset($_POST['submit'])) {
    // Getting Post Values  
    $product_info_id = $buyproduct_id;
    $product_name = $_POST['productName'];
    $product_quantity = $_POST['productQuantity'];
    $product_price = $_POST['productPrice']; 
    $total_amt = $product_price * $product_quantity; 
    $seller_id = $_POST['seller_id'];
    $buyer_id = $_SESSION['aid'];

    // Generate unique transaction_id
    $transaction_id = "OD" . date('dmY') . mt_rand(100, 999);

    // Check if the generated transaction_id already exists in the database
    $query_check_transaction = mysqli_query($con, "SELECT * FROM buyproductrequest WHERE transaction_id = '$transaction_id'");
    $rows_transaction = mysqli_num_rows($query_check_transaction);

    // If the transaction_id already exists, generate a new one until it's unique
    while ($rows_transaction > 0) {
        $transaction_id = "OD" . date('dmY') . mt_rand(100, 999);
        $query_check_transaction = mysqli_query($con, "SELECT * FROM buyproductrequest WHERE transaction_id = '$transaction_id'");
        $rows_transaction = mysqli_num_rows($query_check_transaction);
    }

    // Generate unique invoice_id
    $invoice_id = "INV" . date('dmY') . mt_rand(100, 999);

    // Check if the generated invoice_id already exists in the database
    $query_check_invoice = mysqli_query($con, "SELECT * FROM buyproductrequest WHERE invoice_id = '$invoice_id'");
    $rows_invoice = mysqli_num_rows($query_check_invoice);

    // If the invoice_id already exists, generate a new one until it's unique
    while ($rows_invoice > 0) {
        $invoice_id = "INV" . date('dmY') . mt_rand(100, 999);
        $query_check_invoice = mysqli_query($con, "SELECT * FROM buyproductrequest WHERE invoice_id = '$invoice_id'");
        $rows_invoice = mysqli_num_rows($query_check_invoice);
    }

    // Insert into buyproductrequest table
    $query = mysqli_query($con, "INSERT INTO `buyproductrequest`(`product_id`, `transaction_id`, `invoice_id`,`product_name`, `product_qty`, `product_price`, `product_totalamt`, `seller_id`, `buyer_id`) VALUES 
        ('$product_info_id', '$transaction_id', '$invoice_id', '$product_name', '$product_quantity', '$product_price', '$total_amt', '$seller_id','$buyer_id')");

    if($query){
        echo "<script>alert('Your Buy Product Request was successful. Check your request status.');</script>";
        echo "<script type='text/javascript'> document.location = 'viewbuyproductstatus.php'; </script>";
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
  <title>AgroLink | Buy Product</title>

  <link rel="stylesheet" href="../../farmer/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../farmer/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../farmer/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../farmer/dist/css/adminlte.min.css">
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
            <h1>Buy Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Buy Product</li>
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
            <div class="card card-primary" style="height: 29rem">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
             
              <form name="addProduct" method="post" enctype="multipart/form-data">
              <?php 
              $products_info = mysqli_query($con, "SELECT p.*, l.*, f.*, l.location_name AS lname, p.address AS p_address, f.fullname AS fname, f.email AS femail, f.mobno AS fmobno, f.id AS seller_id
              FROM tblproducts p
              JOIN tbllocations l ON p.location_id = l.id
              JOIN tblfarmer f ON p.addedbyno = f.id
              WHERE p.id = '".$buyproduct_id."' ");


              while ($row = $products_info->fetch_assoc()): ?>
              
                <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter Product Name" value = "<?php echo $row['name'];?>" readOnly>
                    <input type="hidden" class="form-control" id="product_id" name="product_id" placeholder="Enter product_id" value = "<?php echo $row['id'];?>" readOnly>
                   <input type="hidden" class="form-control" id="seller_id" name="seller_id" placeholder="Enter seller_id" value = "<?php echo $row['seller_id'];?>" readOnly>
                  
                  </div>
                  </div>
                  <div class="col-md-6"> <div class="form-group">
                    <label for="productPrice">Product Price (Per Kg)</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter Product Price" value = "<?php echo $row['price'];?>" readOnly>
                  </div></div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="productDescription">Product Description</label>
                    <input type="text" class="form-control" id="productDescription" value = "<?php echo $row['description'];?>" name="productDescription" placeholder="Enter Description" readOnly>
                  </div>
                 </div>
                 <div class="col-md-6">   <div class="form-group">
                    <label for="productDescription">Address</label>
                    <input type="text" class="form-control" id="productAddress1"  value = "<?php echo $row['p_address'].", ".$row['lname'];?>" name="productAddress1" placeholder="Enter Address" readOnly>
                    <input type="hidden" class="form-control" id="productAddress"  value = "<?php echo $row['p_address'];?>" name="productAddress" placeholder="Enter Address" readOnly>
                  </div>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="sellerName">Seller Name</label>
                    <input type="text" class="form-control" id="sellerName"  value = "<?php echo ucwords($row['fname']);?>" name="sellerName" placeholder="Enter Seller Name" readOnly>
                  </div>
                 </div>
                 <div class="col-md-6">  <div class="form-group">
                    <label for="sellerEmail">Seller Email</label>
                    <input type="email" class="form-control" id="sellerEmail"  value = "<?php echo $row['femail'];?>" name="sellerEmail" placeholder="Enter Email" readOnly>
                  </div>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="sellerName">Seller Contact No</label>
                    <input type="number" class="form-control" id="sellerMobno"  value = "<?php echo ucwords($row['fmobno']);?>" name="sellerMobno" placeholder="Enter Seller Mobno" readOnly>
                  </div>
                 </div>
                 <div class="col-md-6">   <div class="form-group">
                    <label for="productQuantity">Product Quantity</label>
                    <input type="number" class="form-control" id="productQuantity" name="productQuantity"  value = "<?php echo $row['quantity'];?>" placeholder="Enter Quantity" required>
                  </div>
                </div>
                </div>
              

<div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit" id="submit">Buy Now</button>
</div>

                </div>
                <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
    
              </form>
       
  <div class="col-md-4">
  <div class="card card-primary" style="height: 29rem">
        <div class="card-header">
            <h3 class="card-title">Product Image</h3>
        </div>
        <div class="card-body">
            <!-- Add your product image here -->
          <center>  <img src="../../uploads/<?php echo $row['image']; ?>" class="img-fluid" alt="Product Image" width="200" style=" border-radius: 10px;"></center><br>
          
          <p style="line-height: 13px;"><b>Seller Name: </b><?php echo $row['fname'];?></p>
          <p style="line-height: 13px;"><b>Seller Email Id: </b><?php echo $row['femail'];?></p>
          <p style="line-height: 13px;"><b>Seller Contact No: </b><?php echo $row['fmobno'];?></p>
          
          <p style="line-height: 13px;"><b>Seller Address: </b><?php echo $row['p_address'].", ".$row['lname'];?></p>
          
          <a class="btn btn-primary" href="../chat/chat.php?user=<?php echo $row['fname']; ?>">
        <i class="fas fa-comments"></i> Message
    </a>
        </div>
        
    </div>
  </div>
          <?php endwhile; ?>
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
<script src="../../farmer/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../farmer/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../farmer/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../farmer/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../farmer/dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="../../farmer/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
</body>
</html>
<?php } ?>
