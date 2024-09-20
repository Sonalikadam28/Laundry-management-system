<?php
session_start();
include('includes/config.php');
 
// Set content type to JSON
header('Content-Type: application/json');
 
// Initialize response array
$response = array();
 
// Check if the request method is POST and barcode is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['barcode']) && !empty($_POST['barcode'])) {
    // Retrieve and sanitize the POST data
    $barcode = mysqli_real_escape_string($con, $_POST['barcode']);
 
    // Sample query - adjust as necessary
    $query = "SELECT tblorder.*, tblcustomer.fullname, tblcustomer.mobno, tblcustomer.address, tblitem.itemname, tblitem.price
              FROM tblorder
              JOIN tblcustomer ON tblorder.cid = tblcustomer.id
              JOIN tblitem ON tblorder.item_id = tblitem.id
              WHERE tblorder.barcode = '$barcode'";
 
    // Execute the query
    $result = mysqli_query($con, $query);
 
    // Check query execution
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $response['success'] = true;
            $items = array();
            $grandTotal = 0;
 
            while ($row = mysqli_fetch_assoc($result)) {
                $response['customerDetails'] = $row['fullname'] . ", " . $row['mobno'] . ", " . $row['address'];
                $items[] = $row['itemname'] . " x " . $row['qty'] . " @ ₹" . $row['price'];
                $grandTotal += $row['qty'] * $row['price'];
            }
 
            $response['items'] = $items;
            $response['grandTotal'] = number_format($grandTotal, 2);
        } else {
            $response['success'] = false;
            $response['message'] = 'No order found for the given barcode.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Database query failed: ' . mysqli_error($con);
    }
 
    // Output JSON response
    echo json_encode($response);
} else {
    // Method not allowed or missing barcode
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array('success' => false, 'message' => 'Invalid request method or missing barcode.'));
}
?>