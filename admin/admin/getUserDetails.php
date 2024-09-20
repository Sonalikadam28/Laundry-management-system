<?php
header('Content-Type: application/json');

session_start();
include('includes/config.php');  // Ensure this includes your DB connection variables

// Check if the barcode is provided
if (isset($_POST['barcode']) && !empty($_POST['barcode'])) {
    $barcode = $_POST['barcode'];

    // Return the barcode in JSON format
    echo json_encode(['success' => true, 'barcode' => $barcode]);
    
} else {
    echo json_encode(['success' => false, 'message' => 'No barcode provided']);
}
?>
