<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label, input {
            display: block;
            margin-bottom: 10px;
        }

        #userDetails {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 500px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Enter Barcode to Fetch User Details</h1>

    <form id="barcodeForm" action="generate_finalinvoice.php" method="POST">
        <label for="barcode">Enter Barcode:</label>
        <input type="text" id="barcode" name="barcode" required>
        <button type="submit">Search</button>
    </form>

    <!-- Section to display user details -->
    <div id="userDetails">
        <!-- User details will be displayed here -->
    </div>

    <script>
document.getElementById('barcodeForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting traditionally

    var barcode = document.getElementById('barcode').value;

    // Send an AJAX request to fetch user details
    fetch('getUserDetails.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'barcode=' + encodeURIComponent(barcode),
})
.then(response => {
    return response.text(); // Get the response as text
})
.then(data => {
    console.log(data); // Log the response to check what you're getting
    // Now try to parse it as JSON
    try {
        const jsonData = JSON.parse(data);
        if (jsonData.success) {
            document.getElementById('userDetails').innerHTML = `<p>Barcode: ${jsonData.barcode}</p>`;
        } else {
            document.getElementById('userDetails').innerHTML = `<p>Error: ${jsonData.message}</p>`;
        }
    } catch (e) {
        console.error('JSON parsing error:', e);
        document.getElementById('userDetails').innerHTML = `<p>An error occurred while fetching details.</p>`;
    }
})
.catch(error => {
    console.error('Error:', error);
    document.getElementById('userDetails').innerHTML = `<p>An error occurred while fetching details.</p>`;
});

});
</script>


</body>
</html>
