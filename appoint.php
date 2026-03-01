<?php

$con = new mysqli('localhost', 'root', '', 'doctor');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $select_a_service = $_POST['select_a_service'];
    $select_doctor = $_POST['select_doctor'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $location = $_POST['location'];

    
    $q = "INSERT INTO appoint (select_a_service, select_doctor, name, email, appointment_date, appointment_time, location) 
          VALUES ('$select_a_service', '$select_doctor', '$name', '$email', '$appointment_date', '$appointment_time', '$location')";

    if ($con->query($q) === TRUE) {
        echo "<script>alert('Appointment Requested!');window.location.replace('home.php');</script>";
    } else {
        echo "Error: " . $con->error;
    }
}

$con->close();
?>
