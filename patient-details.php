<?php
require('fpdf.php');

// Database connection
$con = new mysqli('localhost', 'root', '', 'doctor');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch data from the database
$q = "SELECT * FROM drbooking";
$res = mysqli_query($con, $q);

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Doctor Appointment List', 0, 1, 'C');
        // Line break
        $this->Ln(10);

        // Table header
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(79, 173, 80); // Green background
        $this->SetTextColor(255, 255, 255); // White text

        $this->Cell(30, 10, 'Doctor Name', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Patient Name', 1, 0, 'C', true);
        $this->Cell(10, 10, 'Age', 1, 0, 'C', true);
        $this->Cell(35, 10, 'Appointment Date', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Phone', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Email', 1, 0, 'C', true);
        $this->Cell(45, 10, 'Description', 1, 1, 'C', true);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create a new PDF document
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Table body
$pdf->SetTextColor(0, 0, 0); // Black text

while ($row = mysqli_fetch_array($res)) {
    $doctorname = $row['doctorname'];
    $name = $row['name'];
    $age = $row['age'];
    $date = $row['date'];
    $phone = $row['phone'];
    $email = $row['email'];
    $description = $row['description'];

    $pdf->Cell(30, 10, $doctorname, 1);
    $pdf->Cell(30, 10, $name, 1);
    $pdf->Cell(10, 10, $age, 1, 0, 'C');
    $pdf->Cell(35, 10, $date, 1);
    $pdf->Cell(30, 10, $phone, 1);
    $pdf->Cell(50, 10, $email, 1);
    $pdf->Cell(45, 10, $description, 1, 1);
}

// Output the PDF
$pdf->Output('D', 'Doctor_Appointment_List.pdf'); // Force download with a specified file name

// Close the database connection
$con->close();
?>
