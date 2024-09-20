<?php
header('Content-Type: application/json');

// Simulate fetching item details based on the barcode received
if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    
    // Example: Fetch item details from database based on barcode
    // Replace this with your actual database connection and query
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Database connection failed']));
    }

    // Prepare SQL query (example)
    $sql = "SELECT name, price FROM items WHERE barcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        echo json_encode(['success' => true, 'item' => $item]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No barcode provided']);
}
?>
