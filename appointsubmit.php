<?php

$id = $_POST['id'];
$select_a_service = $_POST['select_a_service'];
$select_doctor = $_POST['select_doctor'];
$name = $_POST['name'];
$email = $_POST['email'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$location = $_POST['location'];
$status = $_POST['status'];

$con = new mysqli('localhost', 'root', '', 'doctor');

$query = "UPDATE appoint 
          SET select_a_service='$select_a_service', select_doctor='$select_doctor', name='$name', email='$email', appointment_date='$appointment_date', appointment_time='$appointment_time', location='$location'
          WHERE id='$id'";


$result = mysqli_query($con, $query);


if ($result) {
    echo '<script>
            alert("Update successful");
            window.location.replace("servicelist.php");
          </script>';
} else {
    echo "Error updating record: " . $con->error;
}



?>
