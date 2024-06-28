<?php
require('./fpdf/fpdf.php');
require('db.php'); // Include your database connection script

class PDF extends FPDF {
    function Header() {
        // Add header
        // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Inventory Table',0,0,'C');
        // Line break
        $this->Ln(20);
    }

    function Footer() {
        // Add footer 
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetX(3);

// Set font
$pdf->SetFont('Arial', '', 8);

// Connect to the database
$con = mysqli_connect("localhost", "username", "password", "sims");

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Query MySQL for data
$query = "SELECT * FROM masterStockRecord, itemCat, stockLocation WHERE masterStockRecord.categoryId = itemCat.id AND masterStockRecord.locationId = stockLocation.id";

$result = $con->query($query);
if (!$result) {
    die("Query error: " . mysqli_error($con));
}

// var_dump($result); // Debugging output
$i = 1; // Initialize a counter
$pdf->Cell(10,10, 'No',1,0,'C');
$pdf->Cell(34,10, 'Item',1,0,'C');
$pdf->Cell(30,10, 'Category',1,0,'C');
$pdf->Cell(25,10, 'Total Amount',1,0,'C');
$pdf->Cell(25,10, 'Amount Used',1,0,'C');
$pdf->Cell(25,10, 'Current Amount',1,0,'C');
$pdf->Cell(35,10, 'Location',1,0,'C');
$pdf->Cell(20,10, 'Supplier',1,1,'C');

// Fetch and display each row from the result set
foreach($result as $row){
    // var_dump($row);
    $pdf->SetX(3);
    $name = $row['name'];
    $CatId = $row['categoryDetail'];
    $TotalQ = $row['totalQuantity'];
    $UsedQ = $row['usedQuantity'];
    $CurrQ = $row['currentQuantity'];
    $Loc = $row['locationName'];
    $Supp = $row['supplierName'];

    // Add data to the PDF with borders
    $pdf->Cell(10, 10, $i,1,0,'C'); 
    $pdf->Cell(34, 10, $name,1,0,'C');
    $pdf->Cell(30, 10, $CatId,1,0,'C'); 
    $pdf->Cell(25, 10, $TotalQ,1,0,'C'); 
    $pdf->Cell(25, 10, $UsedQ,1,0,'C'); 
    $pdf->Cell(25, 10, $CurrQ,1,0,'C'); 
    $pdf->Cell(35, 10, $Loc,1,0,'C'); 
    $pdf->Cell(20, 10, $Supp,1,1,'C'); 
    $i++; // Increment the counter
}

// Output PDF to the browser or save to a file
$pdf->Output();
?>
