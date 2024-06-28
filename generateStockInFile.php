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
        $this->Cell(30,10,'Stock In Table',0,0,'C');
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
$pdf->SetX(15);

// Set font
$pdf->SetFont('Arial', '', 10);

// Connect to the database
$con = mysqli_connect("localhost", "username", "password", "sims");

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Query MySQL for data
$query = "SELECT * FROM stockIn, masterStockRecord WHERE stockIn.id = masterStockRecord.id";

$result = $con->query($query);
if (!$result) {
    die("Query error: " . mysqli_error($con));
}

// var_dump($result); // Debugging output
$i = 1; // Initialize a counter
$pdf->Cell(10,10, 'No',1,0,'C');
$pdf->Cell(50,10, 'Item',1,0,'C');
$pdf->Cell(30,10, 'Quantity',1,0,'C');
$pdf->Cell(65,10, 'Received By',1,0,'C');
$pdf->Cell(25,10, 'Date',1,1,'C');

// Fetch and display each row from the result set
foreach($result as $row){
    // var_dump($row);
    $pdf->SetX(15);
    $name = $row['name'];
    $Quantity = $row['quantity'];
    $ReceivedBy = $row['receivedBy'];
    $Date = $row['date'];

    // Add data to the PDF with borders
    $pdf->Cell(10, 10, $i,1,0,'C'); 
    $pdf->Cell(50, 10, $name,1,0,'C');
    $pdf->Cell(30, 10, $Quantity,1,0,'C'); 
    $pdf->Cell(65, 10, $ReceivedBy,1,0,'C'); 
    $pdf->Cell(25, 10, $Date,1,1,'C'); 
    $i++; // Increment the counter
}

// Output PDF to the browser or save to a file
$pdf->Output();
?>
