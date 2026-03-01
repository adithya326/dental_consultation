<?php

$doctorname = $_POST['doctorname'];
$name = $_POST['name'];
$age = $_POST['age'];
$date = $_POST['date'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$description = $_POST['description'];

$conn = new mysqli('localhost', 'root', '', 'doctor');

$q = "INSERT INTO drbooking (doctorname, name, age, date, phone, email, description) 
      VALUES ('$doctorname', '$name', '$age', '$date', '$phone', '$email', '$description')";

$result = mysqli_query($conn, $q);
if ($result) {
    echo "<script>alert('Booking Request is Sent'); window.location.replace('home.php');</script>";
} else {
    echo 'Error: ' . mysqli_error($conn); // Show the actual SQL error for debugging
}

?>
