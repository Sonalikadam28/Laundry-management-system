<?php
session_start();
include('includes/config.php');
require '../../vendor/autoload.php'; // Include the composer autoload file for the barcode library

use Picqer\Barcode\BarcodeGeneratorPNG;

if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit;
}

// Initialize variables
$itemIds = [];
$quantities = [];
$barcodes = [];
$totalPrice = 0;

// Check if required data is provided






// Check if required data is provided
if (isset($_POST['itemId']) && isset($_POST['quantity'])) {

    $itemIds = isset($_POST['itemId']) ? $_POST['itemId'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];

    // Generate unique ID (10 digits)
    $uniqueId = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

    // Fetch item names and prices from the database
    $itemDetails = [];
    foreach ($itemIds as $itemId) {
        $query = mysqli_query($con, "SELECT itemname, price FROM tblitem WHERE id = '$itemId'");
        if ($row = mysqli_fetch_assoc($query)) {
            $itemDetails[$itemId] = [
                'name' => $row['itemname'],
                'price' => $row['price']
            ];
        } else {
            $itemDetails[$itemId] = [
                'name' => "Unknown Item",
                'price' => 0 // Fallback price if item not found
            ];
        }
    }

    // Calculate total price and generate barcodes
    $generator = new BarcodeGeneratorPNG();

    foreach ($itemIds as $index => $itemId) {
        $quantity = $quantities[$index];
        if ($quantity > 0) {
            $itemName = isset($itemDetails[$itemId]) ? $itemDetails[$itemId]['name'] : "Unknown Item";
            $price = $itemDetails[$itemId]['price'];
            $total = $quantity * $price;
            $totalPrice += $total; // Add to grand total

            // Generate barcode for each item
            for ($i = 0; $i < $quantity; $i++) {
                $barcodes[] = base64_encode($generator->getBarcode($uniqueId, BarcodeGeneratorPNG::TYPE_CODE_128));
            }
        }
    }

    // Generate only one barcode for display on the main page
    $singleBarcode = base64_encode($generator->getBarcode($uniqueId, BarcodeGeneratorPNG::TYPE_CODE_128));

    if( isset($_POST['fullname']) && isset($_POST['mobileno']) && isset($_POST['address']) && !empty($_POST['fullname']) && !empty($_POST['mobileno']) && !empty($_POST['address']) ){
// Customer details
$fname = $_POST['fullname'];
$mobileno = $_POST['mobilenumber'];
$address = $_POST['address'];

// Insert customer details into tblcustomer
$query = mysqli_query($con, "INSERT INTO tblcustomer(fullname, mobno, address) VALUES('$fname', '$mobileno', '$address')");

if ($query) {
    // Get the last inserted customer ID
    $customerId = mysqli_insert_id($con);

    // Loop through items and insert order details into tblorder
    foreach ($itemIds as $index => $itemId) {
        $quantity = $quantities[$index];
        if ($quantity > 0) { // Unique barcode per item
            mysqli_query($con, "INSERT INTO tblorder(cid, item_id, qty, barcode, price) VALUES('$customerId', '$itemId', '$quantity', '$uniqueId', '$price')");
        }
    }

    echo "<script>alert('Customer details and order added successfully.');</script>";
} else {
    echo "<script>alert('Something went wrong. Please try again.');</script>";
}
    }else{
        echo "<script>alert('Incomplete .');</script>";
    }
    
} else {
    echo "Incomplete data found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barcode Generation Result</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../investor/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
    <style>
        .table-container {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .table .total-row {
            font-weight: bold;
        }
        .barcode-container {
            margin-bottom: 1rem;
        }
        .barcode-item {
            display: inline-block;
            text-align: center;
            margin: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Barcode Details</h3>
        </div>
        <div class="card-body">
            <!-- Customer Details -->
            <strong>Customer Name:</strong> <?php echo ucwords(htmlspecialchars($_POST['fullname'])); ?> 
            
            <!-- Items Ordered Table -->
            <table class="table table-bordered table-container mt-3">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price per Item</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($itemIds as $index => $itemId) {
                    $quantity = $quantities[$index];
                    if ($quantity > 0) { // Only display items with quantity greater than 0
                        $itemName = isset($itemDetails[$itemId]) ? $itemDetails[$itemId]['name'] : "Unknown Item";
                        $price = $itemDetails[$itemId]['price'];
                        $total = $quantity * $price;
                        echo "<tr>
                                <td>" . htmlspecialchars($itemName) . "</td>
                                <td>" . htmlspecialchars($quantity) . "</td>
                                <td>₹" . number_format($price, 2) . "</td>
                                <td>₹" . number_format($total, 2) . "</td>
                              </tr>";
                    }
                }
                ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3" class="text-right">Grand Total:</td>
                        <td>₹<?php echo number_format($totalPrice, 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Display Only One Barcode on the Main Page -->
            <div class="barcode-container text-center mt-3">
                <div class="barcode-item">
                    <img src="data:image/png;base64,<?php echo $singleBarcode; ?>" alt="Barcode">
                    <div><?php echo preg_replace('/([0-9])/s', '$1 ', htmlspecialchars($uniqueId)); ?></div>
                </div>
            </div>
            <center>
            <button id="printBtn" class="btn btn-primary mt-3 text-center">Print</button>

            </center>
        </div>
    </div>

    <script src="../../investor/plugins/jquery/jquery.min.js"></script>
    <script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../investor/dist/js/adminlte.min.js"></script>

    <script>
        document.getElementById('printBtn').addEventListener('click', function() {
            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Print Barcode</title></head><body>');
            printWindow.document.write('<div style="text-align:center;">');

            // Insert the barcodes dynamically into the print window
            <?php foreach ($barcodes as $barcode): ?>
                var barcodeSrc = 'data:image/png;base64,<?php echo $barcode; ?>';
                var barcodeNumber = '<?php echo preg_replace('/([0-9])/s', '$1 ', htmlspecialchars($uniqueId)); ?>';
                printWindow.document.write('<div style="margin-bottom:1rem;">');
                printWindow.document.write('<img src="' + barcodeSrc + '" style="width:250px;height:auto;"><br>');
                printWindow.document.write('<div style="letter-spacing: 6px;">' + barcodeNumber + '</div>');
                printWindow.document.write('</div>');
            <?php endforeach; ?>

            printWindow.document.write('</div></body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</body>
</html>
