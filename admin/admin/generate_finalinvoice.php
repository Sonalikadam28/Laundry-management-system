<?php
header('Content-Type: application/json');

session_start();
include('includes/config.php');  // Assuming this file contains $servername, $username, $password, and $dbname

// Check if the barcode is provided
if (isset($_POST['barcode']) && !empty($_POST['barcode'])) {
    $barcode = $_POST['barcode'];

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
        exit();
    }

    // Prepare the SQL query to fetch user details based on the barcode
    $sql = "SELECT fullname FROM tblcustomer WHERE barcode = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $barcode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Now fetch the purchased items for the user
            $sql_items = "
                SELECT tblitem.itemname, tblorder.qty, tblorder.price, (tblorder.qty * tblorder.price) AS total 
                FROM tblorder 
                JOIN tblitem ON tblorder.item_id = tblitem.id 
                WHERE tblorder.barcode = ?
            ";
            if ($stmt_items = $conn->prepare($sql_items)) {
                $stmt_items->bind_param("s", $barcode);
                $stmt_items->execute();
                $result_items = $stmt_items->get_result();

                $items = [];
                $totalAmount = 0;

                while ($row = $result_items->fetch_assoc()) {
                    $items[] = [
                        'name' => $row['itemname'],  // Correctly fetch item name
                        'quantity' => $row['qty'],
                        'price' => $row['price'],
                        'total' => $row['total']
                    ];
                    $totalAmount += $row['total'];
                }

                // Return user info along with items and total
                echo json_encode([
                    'success' => true,
                    'user' => $user,
                    'items' => $items,
                    'total' => $totalAmount
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare item query: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare user query: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No barcode provided']);
}
