

<?php
$connection = mysqli_connect("localhost:3307", "root", "");
// Selecting Database
$db = mysqli_select_db($connection, "agrolink_db");
if (!isset($_SESSION)) {
  session_start(); 
}


if (isset($_GET['id'])) {
  $query_transaction = "select * from buyproductrequest where transaction_id = '{$_GET['id']}'";
  $result = mysqli_query($connection, $query_transaction);
  $row = mysqli_fetch_assoc($result);
  $sub_total = $row['product_price'];
  $product_name = $row['product_name'];
  
  $product_quantity = $row['product_qty'];
  $net_total = $row['product_totalamt'];
  $customer_id    = $row['buyer_id'];
  $farmer_id    = $row['seller_id'];
  $date           = $row['reg_date'];
  $total_quantity = 0;
  $gst            = ($net_total*18)/100;
  $discount       = '0';
  $paid           = $row['product_totalamt'];
  $order_id       = $row['transaction_id'];
  $invoice_id     = $row['invoice_id'];
  $formatted_date = date("d-m-Y", strtotime($date));
?>
<?php
  require('../fpdf.php');
  // Header of Procure PDF :-
  $pdf = new FPDF('P', 'mm', 'A4');
  $pdf->AddPage();
  $pdf->SetAuthor("AGROLINK Pvt Ltd.");
  $pdf->SetSubject("Invoice");
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->SetFont('');
  $pdf->Image('AGROLINK LOGO.png', 8, 10, -300);
  $pdf->SetY(14);
  $pdf->Cell(39);

  $pdf->write(1.5, "Contact us: +91-8830678561 || anurag@gmail.com");
  $pdf->Ln();
  $pdf->SetY(15);
  $pdf->Cell(39);
  $pdf->Write(6.5, "AGROLINK Services Pvt. Ltd., ");
  $pdf->SetFont('Arial', 'I', 7);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Write(6.6, "Address: Prof. PRMITR College, Amravati - 444604");
  $pdf->SetY(12);
  $pdf->Image('dooted_box.png', 155, 10, 50, 10);
  $pdf->SetXY(5, 6);
  $pdf->Cell(158);
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->SetFont('');
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetY(11.4);
  $pdf->Cell(148.8);
  $pdf->Cell(42, 7, 'Invoice # ' . $invoice_id, 0, 0, 'C');
  $pdf->Line(5, 25, 205, 25);
  // Header ends.
  // TODO Order ID and Billing address and shipping address...........
  $pdf->SetXY(10, 30);
  
  $order_details = array(
    "Order ID: " . $order_id,
    "Order Date: " . $formatted_date,
    "Invoice No: " . $invoice_id,
    "Invoice Date: " . date("d-m-Y"),
    "GST: 27AADPD5951A1Z7"
  );
  for ($i = 0; $i < 5; $i++) {
    if ($i == 0) {
      $pdf->SetFont('Arial', 'B', 8);
    } else {
      $pdf->SetFont('');
    }
    $pdf->Write(0.7, $order_details[$i]);
    $pdf->Ln(4);
  }
  $query_customer = "SELECT tblbuyer.*, tbllocations.*, tbllocations.location_name AS buyer_locationname FROM tblbuyer JOIN tbllocations ON tblbuyer.location_id = tbllocations.id WHERE tblbuyer.id ='{$customer_id}'";
  $result23 = mysqli_query($connection, $query_customer);
  $row_customer = mysqli_fetch_assoc($result23);
  $BaddressLine1 = $row_customer['address'];
  $BaddressLine2 = $row_customer['buyer_locationname'];

  $billing_address = array(
    "Customer Billing Address:",
    ucwords($row_customer['fullname']),
    $row_customer['mobno'],
    $row_customer['email'],
    $BaddressLine1.", ".$BaddressLine2,
);

  $pdf->SetXY(55, 25.6);
  for ($i = 0; $i < 5; $i++) {
    $pdf->SetXY(60, $pdf->getY() + 4);
    if ($i == 0) {
      $pdf->SetFont('Arial', 'B', 8);
    } else {
      $pdf->SetFont('');
    }
    $pdf->Write(0.7, $billing_address[$i]);
  }

  $query_farmer = "SELECT tblfarmer.*, tbllocations.*, tbllocations.location_name AS seller_locationname FROM tblfarmer JOIN tbllocations ON tblfarmer.location_id = tbllocations.id WHERE tblfarmer.id ='{$farmer_id}'";
  $result24 = mysqli_query($connection, $query_farmer);
  $row_farmer = mysqli_fetch_assoc($result24);
  $seller_name = $row_farmer['fullname'];
  $seller_email = $row_farmer['email'];
  $seller_mobno = $row_farmer['mobno'];
  $SaddressLine11 = $row_farmer['address'];
  $SaddressLine12 = $row_farmer['seller_locationname'];
  $pdf->SetXY(110, 25.6);
  $shipping_address = array(
    'Seller Information:',
    ucwords($seller_name),
    $seller_mobno,
    $seller_email,
    $SaddressLine11.", ".$SaddressLine12,
  );

  for ($i = 0; $i < 5; $i++) {
    $pdf->SetXY(150, $pdf->getY() + 4);
    if ($i == 0) {
      $pdf->SetFont('Arial', 'B', 8);
    } else {
      $pdf->SetFont('');
    }
    $pdf->Write(0.7, $shipping_address[$i]);
  }
  // Order ID and Billing address and shipping address END.


  $pdf->Line(5, $pdf->GetY() + 6, 205, $pdf->GetY() + 6);

  # TABLE .....................
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->setXY(5, $pdf->GetY() + 12);
  $pdf->Cell(18, 10, "Sr. No.", 0, 0, "C");
  $pdf->Cell(45, 10, "Product", 0, 0, "C");
  // $pdf->Cell(45, 10, "Title", 0, 0, "C");
  $pdf->Cell(45, 10, "Quantity", 0, 0, "C");
  $pdf->Cell(38, 10, "Price / Kg", 0, 0, "C");
  $pdf->Cell(24, 10, "GST (18.0%)", 0, 0, "C");
  $pdf->Cell(26, 10, "    Total (Rs)", 0, 1, "C");
  $pdf->SetX(5);
   $x = $pdf->GetX();
    $y = $pdf->GetY();
    $total_gst = $gst;
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(18, 10, '1.', 0, "C");
    $pdf->SetXY($x + 33, $y + 2);
    $pdf->MultiCell(55, 5, $product_name, 0, "L");
   
    $x = 68;
    $pdf->SetXY($x + 17, $y);
    $x = $x + 45;
    $pdf->MultiCell(11, 10, $product_quantity, 0, "C");
    $pdf->SetXY($x + 4, $y);
    $x = $x + 11;
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->MultiCell(24, 10, number_format($sub_total, 2), 0, "C");
    $pdf->SetXY($x + 24, $y);
    $x = $x + 24;
    $pdf->MultiCell(24, 10, number_format($total_gst, 2), 0,  "C");
    $pdf->SetXY($x + 24, $y);
    $x = $x + 24;
    $pdf->MultiCell(26, 10, number_format($net_total, 2), 0, "R");

  // Final Row END ....................
  // LumSum ...................
  $x = 113;
  $y = $y + 12;
  $pdf->SetXY($x, $y);
  $pdf->SetFillColor(143, 188, 143);
  $pdf->SetFont('Arial', 'B', 12);

  $pdf->Cell(45, 7, "GRAND TOTAL", 0, 0, "C", TRUE);
  $pdf->SetXY($x + 45, $y);
  $x = $x + 45;
  $pdf->Cell(40, 7, "Rs " . number_format($net_total, 2), 0, 0, "R", TRUE);

  // LumSum END...............
  $pdf->Line(5, $y + 13, 205, $y = $y + 13);
  # TABLE END.

  $pdf->SetXY(5, $y + 5);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetTextColor(72, 72, 72);
  $pdf->MultiCell(90, 5, "Bank Details for Direct Deposit:\nA/C Name - Anurag Gulane \nA/C No. - 098501511556\nIFSC Code- SBIN0000502");

  $pdf->SetXY(175, $y + 5);
  $pdf->Image("stamp.png", 175, $y = $y + 7, -200);
  $pdf->SetFont('Arial', '', 9);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Write(0, "For AGROLINK");
  $pdf->SetXY(168, $y + 28);
  $pdf->Write(0, "Authorized Signatory");
  $pdf->SetFont('Arial', 'I', 8);
  $impY = (280 - $y) / 2;
  $pdf->SetXY(65, $y + $impY);
  $pdf->SetTextColor(128, 128, 128);
  $pdf->Write(0, "**This is a computer generated invoice. No signature required.**");
  $pdf->Image("AGROLINK LOGO.png", 165, 253, -350);
  $pdf->SetXY(165, 265.5);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->MultiCell(50, 5, "     THANK YOU!");
  # FOOTER 
  $pdf->Output('', $row_customer['fullname'] . " (#" . $invoice_id . ").pdf");
} else {
  echo "Not Found";
}
