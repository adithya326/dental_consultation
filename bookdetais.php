<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Booking Prescriptions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        header {
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.5em;
        }
        .welcome-message {
            font-size: 1.1em;
            color: #333;
            margin-top: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
            margin-top: 40px;
            color: #4CAF50;
            font-size: 1.3em;
        }
        table {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
        }
        thead tr {
            background-color: #4CAF50;
            color: white;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #ddd;
        }
        th {
            font-weight: bold;
        }
        td {
            font-size: 0.9em;
            color: #333;
        }
        .action-btn {
            color: #ff3333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ff3333;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin: 0 5px; /* Add margin for spacing */
        }
        .action-btn:hover {
            background-color: #ff3333;
            color: #ffffff;
        }
        .no-bookings {
            font-size: 1.1em;
            color: #666;
            text-align: center;
            padding: 20px;
        }
        .status-description {
            color: #2d862d;
            font-size: 0.85em;
            font-style: italic;
        }
    </style>
</head>
<body>

<?php
session_start();
$email = $_SESSION['logged'];

// Check if the user is logged in
if (!isset($email)) {
    echo "<p>Please log in to view your bookings.</p>";
    exit;
}
?>

<header>Doctor Booking Prescriptions</header>
<div class="welcome-message">Welcome, <?php echo htmlspecialchars($email); ?></div>

<!-- First Table for Approved Bookings -->
<table>
    <thead>
        <tr>
            <th>Token Number</th>
            <th>Doctor Name</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Date</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$con = new mysqli('localhost', 'root', '', 'doctor');

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to fetch only approved bookings for the logged-in user
$q = "SELECT * FROM drbooking WHERE status='approve' AND email='$email'";
$result = $con->query($q);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];  // Assuming `id` is the unique token number
        $doctorname = $row['doctorname'];
        $name = $row['name'];
        $age = $row['age'];
        $date = $row['date'];
        $phone = $row['phone'];
        $description = $row['description'];
        $status = $row['status'];
?>
        <tr>
            <td><?php echo htmlspecialchars($id); ?></td>
            <td><?php echo htmlspecialchars($doctorname); ?></td>
            <td><?php echo htmlspecialchars($name); ?></td>
            <td><?php echo htmlspecialchars($age); ?></td>
            <td><?php echo htmlspecialchars($date); ?></td>
            <td><?php echo htmlspecialchars($phone); ?></td>
            <td><?php echo htmlspecialchars($email); ?></td>
            <td><?php echo htmlspecialchars($description); ?></td>
            <td>
                <?php echo htmlspecialchars($status); ?>
                <div class="status-description">Booking approved for consultation.</div>
            </td>
            <td>
                <a href="cancel.php?id=<?php echo $id; ?>" class="action-btn">Cancel</a><br><br>
                <a href="drpayment.php?id=<?php echo $id; ?>" class="action-btn">Payment</a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='10' class='no-bookings'>No approved bookings found.</td></tr>";
}

?>
    </tbody>
</table>

<!-- Heading for Service Bookings -->
<h2>Service Bookings</h2>

<!-- Second Table for Approved Appointments -->
<table>
    <thead>
        <tr>
            <th>Token No</th>
            <th>Service</th>
            <th>Doctor Name</th>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php

// Query to fetch only approved appointments for the logged-in user
$appointmentQuery = "SELECT * FROM appoint WHERE status='approve' AND email='$email'";
$appointmentResult = $con->query($appointmentQuery);

// Check if the query was successful
if ($appointmentResult && $appointmentResult->num_rows > 0) {
    while ($appointmentRow = $appointmentResult->fetch_assoc()) {
        $id = $appointmentRow['id'];
        $service = $appointmentRow['select_a_service'];
        $select_doctor = $appointmentRow['select_doctor'];
        $patientName = $appointmentRow['name'];
        $patientEmail = $appointmentRow['email'];
        $appointmentDate = $appointmentRow['appointment_date'];
        $appointmentTime = $appointmentRow['appointment_time'];
        $location = $appointmentRow['location'];
        $status = $appointmentRow['status'];
?>
        <tr>
            <td><?php echo htmlspecialchars($id); ?></td>
            <td><?php echo htmlspecialchars($service); ?></td>
            <td><?php echo htmlspecialchars($select_doctor); ?></td>
            <td><?php echo htmlspecialchars($patientName); ?></td>
            <td><?php echo htmlspecialchars($patientEmail); ?></td>
            <td><?php echo htmlspecialchars($appointmentDate); ?></td>
            <td><?php echo htmlspecialchars($appointmentTime); ?></td>
            <td><?php echo htmlspecialchars($location); ?></td>
            <td><?php echo htmlspecialchars($status); ?></td>
            <td>
                <a href="sercancel.php?id=<?php echo $id; ?>" class="action-btn">Cancel</a><br>
                <br>
                <a href="serpayment.php?id=<?php echo $id; ?>" class="action-btn">Payment</a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='10' class='no-bookings'>No approved appointments found.</td></tr>";
}

// Close the connection
$con->close();
?>
    </tbody>
</table>
</body>
</html>
