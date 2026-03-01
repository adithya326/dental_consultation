<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['email'];
$service_rating = $_POST['service_rating'];
$feedback = $_POST['feedback'];


$sql = "INSERT INTO feedback (name, email,  service_rating, feedback) 
        VALUES ('$name', '$email', '$service_rating', '$feedback')";

$result=mysqli_querry($conn,$sql);
if ($result) {
    echo "<script>alert('Thank you for your feedback!');window.location.replace('home.php');</script>";
} else {
    echo "Error: " 
}


$conn->close();
?>
