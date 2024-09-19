<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
  if(isset($_POST['submit'])) {
    // Getting Post Values  
    $p_name = $_POST['p_name'];
    $p_qty = $_POST['p_qty'];
    $p_price = $_POST['p_price'];
    $p_address = $_POST['p_address'];
    $product_description = $_POST['product_description'];
    $p_city = $_POST['p_city'];
    $addedby = $_SESSION['uname'];

    $addedbyno = $_SESSION['aid'];

    // Handling image upload
    $targetDir = "../../uploads/"; // Directory where images will be stored
    $fileName = basename($_FILES["p_image"]["name"]);
    $targetFilePath = "$targetDir" . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["p_image"]["tmp_name"], $targetFilePath)){
            // Insert product details into database
            $query = mysqli_query($con,"INSERT INTO tblproducts (name, quantity,description, price, image, address, location_id, addedby, addedbyno) VALUES ('$p_name', '$p_qty', '$product_description','$p_price', '$fileName', '$p_address', '$p_city', '$addedby', '$addedbyno')");
            if($query){
                echo "<script>alert('Product added successfully.');</script>";
                echo "<script type='text/javascript'> document.location = 'manage-products.php'; </script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    } else {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, & GIF files are allowed.');</script>";
    }
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AgroLink | Add Products</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="addproduct" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"> <label for="exampleInputFullname">Product Name</label>
                    <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter Product Name" required></div>
                    <div class="col-md-6"> <label for="exampleInputFullname">Product Quantity (Per Pic / Kg)</label>
                    <input type="number" class="form-control" id="p_qty" name="p_qty" placeholder="Enter Product Quantity" required></div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-6"> <label for="exampleInputFullname">Product Price</label>
                    <input type="number" class="form-control" id="p_price" name="p_price" placeholder="Enter Product Price" required></div>
                    <div class="col-md-6"> <label for="exampleInputFullname">Address</label>
                    <input type="text" class="form-control" id="p_address" name="p_address" placeholder="Enter Address" required></div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-6"> <label for="exampleInputFullname">Location</label>
                    <select style=" cursor: pointer;" name="p_city" id="p_city" class="form-control demo-default" required>
        <?php 
        $sql = "SELECT * FROM `tbllocations`;";
        $result = $con->query($sql);
        foreach ($result as $r) {
        ?>
        <option value="<?php echo $r['id']; ?>"><?php echo $r['location_name']; ?></option>
        <?php } ?>
    </select></div>
                    <div class="col-md-6"> <label for="exampleInputFullname">Select Product Image</label>
                    <input type="file" class="form-control" id="p_image" name="p_image" style="cursor: pointer" required>
                  </div>
                  </div>
                  <div class="form-group mt-3">
    <label for="product_description">Product Description</label>
    <textarea class="form-control" id="product_description" name="product_description" rows="2" placeholder="Enter product description"></textarea>
</div>

                  <button type="submit" class="btn btn-primary mt-3" name="submit" id="submit">Submit</button>
                         </div>
                <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
    
              </form>
       
  
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
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
