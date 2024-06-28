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
        $this->Cell(30,10,'User Table',0,0,'C');
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
$query = "SELECT * FROM users, contact WHERE users.id = contact.id";

$result = $con->query($query);
if (!$result) {
    die("Query error: " . mysqli_error($con));
}

// var_dump($result); // Debugging output
$i = 1; // Initialize a counter
$pdf->Cell(10,10, 'No',1,0,'C',);
$pdf->Cell(15,10, 'Surname',1,0,'C');
$pdf->Cell(20,10, 'Given name',1,0,'C');
$pdf->Cell(18,10, 'DOB',1,0,'C');
$pdf->Cell(15,10, 'Gender',1,0,'C');
$pdf->Cell(20,10, 'Phone',1,0,'C');
$pdf->Cell(33,10, 'Email',1,0,'C');
$pdf->Cell(37,10, 'Address',1,0,'C');
$pdf->Cell(15,10, 'Postcode',1,0,'C');
$pdf->Cell(22,10, 'City', 1,1,'C');

// Fetch and display each row from the result set
foreach($result as $row){
    // var_dump($row);
    $pdf->SetX(3);
    $fname = $row['Fname'];
    $lname = $row['Lname'];
    $dob = $row['DOB'];
    $gender = $row['gender'];
    $phone = $row['phoneNo'];
    $email = $row['email'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];

    // Add data to the PDF with borders
    $pdf->Cell(10, 10, $i,1,0,'C'); 
    $pdf->Cell(15, 10, $fname,1,0,'C');
    $pdf->Cell(20, 10, $lname,1,0,'C'); 
    $pdf->Cell(18, 10, $dob,1,0,'C'); 
    $pdf->Cell(15, 10, $gender,1,0,'C'); 
    $pdf->Cell(20, 10, $phone,1,0,'C'); 
    $pdf->Cell(33, 10, $email,1,0,'C'); 
    $pdf->Cell(37, 10, $address,1,0,'C'); 
    $pdf->Cell(15, 10, $postcode,1,0,'C'); 
    $pdf->Cell(22, 10, $city,1,1,'C'); 
    $i++; // Increment the counter
}

// Output PDF to the browser or save to a file
$pdf->Output();
?>
