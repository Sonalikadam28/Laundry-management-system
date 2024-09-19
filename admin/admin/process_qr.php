<?php
if (isset($_POST['qr_code_data'])) {
    $qrCodeData = $_POST['qr_code_data'];

    // Process the QR code data (e.g., save it to the database or perform an action)
    echo "QR Code Scanned Data: " . htmlspecialchars($qrCodeData);

    // You can redirect, save to the database, or perform any other action here
} else {
    echo "No QR code data received.";
}
?>
