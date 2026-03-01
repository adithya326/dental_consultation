<?php
require('fpdf.php');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'doctor');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$q = "SELECT * FROM appoint";
$result = mysqli_query($conn, $q);

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Appointment List', 0, 1, 'C');
        // Line break
        $this->Ln(10);

        // Table header
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(79, 173, 80); // Green background
        $this->SetTextColor(255, 255, 255); // White text

        $this->Cell(10, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Service', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Doctor', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Name', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Email', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Date', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Time', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Location', 1, 1, 'C', true);
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
$pdf->SetFont('Arial', '', 10);

// Table body
$pdf->SetTextColor(0, 0, 0); // Black text

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $select_a_service = $row['select_a_service'];
    $select_doctor = $row['select_doctor'];
    $name = $row['name'];
    $email = $row['email'];
    $appointment_date = $row['appointment_date'];
    $appointment_time = $row['appointment_time'];
    $location = $row['location'];

    $pdf->Cell(10, 10, $id, 1);
    $pdf->Cell(30, 10, $select_a_service, 1);
    $pdf->Cell(30, 10, $select_doctor, 1);
    $pdf->Cell(30, 10, $name, 1);
    $pdf->Cell(50, 10, $email, 1);
    $pdf->Cell(30, 10, $appointment_date, 1);
    $pdf->Cell(20, 10, $appointment_time, 1);
    $pdf->Cell(30, 10, $location, 1, 1);
}

// Output the PDF
$pdf->Output('D', 'Appointment_List.pdf'); // Forces download with the filename "Appointment_List.pdf"

// Close the database connection
$conn->close();
?>
