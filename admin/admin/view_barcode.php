<?php
session_start();
include('includes/config.php');
require '../../vendor/autoload.php'; // Include the composer autoload file for the barcode library

use Picqer\Barcode\BarcodeGeneratorPNG;

// Check if user is logged in
if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
    exit;
}

// Check if required data is provided
if (!isset($_GET['label']) || !isset($_GET['items']) || !isset($_GET['quantities'])) {
    echo "Incomplete data found.";
    exit;
}

$uniqueId = htmlspecialchars($_GET['label']);

// Decode and unserialize arrays
$itemIds = isset($_GET['items']) ? unserialize(urldecode($_GET['items'])) : [];
$quantities = isset($_GET['quantities']) ? unserialize(urldecode($_GET['quantities'])) : [];

// Debug: Check if arrays are valid
if (!is_array($itemIds)) {
    echo "Error: Invalid items data.";
    var_dump($_GET['items']);  // Debug: Check raw data
    exit;
}

if (!is_array($quantities)) {
    echo "Error: Invalid quantities data.";
    var_dump($_GET['quantities']);  // Debug: Check raw data
    exit;
}

// Further check if both arrays have the same length
if (count($itemIds) !== count($quantities)) {
    echo "Error: Items and quantities count mismatch.";
    exit;
}

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

// Calculate total price
$totalPrice = 0;
foreach ($itemIds as $index => $itemId) {
    $quantity = $quantities[$index];
    $price = $itemDetails[$itemId]['price'];
    $totalPrice += $quantity * $price;
}

// Generate the barcode image
$generator = new BarcodeGeneratorPNG();
$barcode = base64_encode($generator->getBarcode($uniqueId, $generator::TYPE_CODE_128)); // Generating a Code 128 barcode
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Barcode</title>
    <link rel="stylesheet" href="../../investor/dist/css/adminlte.min.css">
    <style>
     body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        background-color: #f4f6f9;
        color: #333;
        margin: 0;
        padding: 0;
        height: 100vh; /* Ensure body takes full height */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center text inside the container */
    }

    h3, h4 {
        margin-bottom: 15px;
        color: #007bff;
    }

    .barcode-container {
        margin-bottom: 30px;
    }

    .barcode-container img {
        width: 250px; /* Adjust size here */
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .barcode-number {
        letter-spacing: 6px;
    }

    .section {
        margin-bottom: 30px;
    }

    .section ul {
        list-style-type: none;
        padding: 0;
    }

    .section ul li {
        font-size: 16px;
        padding: 8px 0;
        border-bottom: 1px solid #ddd;
    }

    .section ul li:last-child {
        border-bottom: none;
    }

    hr {
        border-top: 1px solid #ddd;
    }

    .total-price {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }

    button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
<div class="container">
    <h3>Generated Barcode:</h3>
    <div class="barcode-container">
        <img id="bcode" src="data:image/png;base64,<?php echo $barcode; ?>" alt="Barcode">
        <div class="barcode-number"><?php echo preg_replace('/([0-9])/s','$1 ', $uniqueId); ?></div>
    </div>
    <hr>
    
    <div class="section">
        <h4>Customer Details</h4>
        <ul>
            <li><strong>Full Name:</strong> <?php echo isset($_GET['fullname']) ? htmlspecialchars($_GET['fullname']) : "Not provided"; ?></li>
            <li><strong>Mobile Number:</strong> <?php echo isset($_GET['mobilenumber']) ? htmlspecialchars($_GET['mobilenumber']) : "Not provided"; ?></li>
            <li><strong>Address:</strong> <?php echo isset($_GET['address']) ? htmlspecialchars($_GET['address']) : "Not provided"; ?></li>
        </ul>
    </div>

    <div class="section">
        <h4>Items Ordered</h4>
        <ul>
            <?php
            for ($i = 0; $i < count($itemIds); $i++) {
                $itemId = $itemIds[$i];
                $quantity = $quantities[$i];
                $itemName = isset($itemDetails[$itemId]) ? $itemDetails[$itemId]['name'] : "Unknown Item";
                echo "<li><strong>$itemName</strong>: $quantity</li>";
            }
            ?>
        </ul>
        <div class="total-price">Total Price: ₹<?php echo number_format($totalPrice, 2); ?></div>
    </div>

    <button id="printBtn">Print</button>

    <script>
        document.getElementById('printBtn').addEventListener('click', function() {
            var quantity = <?php echo json_encode($quantities); ?>;
            var barcodeSrc = document.getElementById('bcode').src;
            
            // Open a new window to print barcodes
            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Print Barcodes</title></head><body>');
            
            // Loop through quantities to print multiple barcodes
            for (var i = 0; i < quantity.length; i++) {
                for (var j = 0; j < quantity[i]; j++) {
                    printWindow.document.write('<div style="text-align:center;">');
                    printWindow.document.write('<img src="' + barcodeSrc + '" style="width:250px;height:auto;"><br>');
                    printWindow.document.write('<div style="letter-spacing: 6px;"><?php echo preg_replace("/([0-9])/s","$1 ", $uniqueId); ?></div>');
                    printWindow.document.write('</div><br>');
                }
            }
            
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</div>

<script src="../../investor/plugins/jquery/jquery.min.js"></script>
<script src="../../investor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../investor/dist/js/adminlte.min.js"></script>
</body>
</html>
