<?php

$id = $_POST['id'];
$doctorname = $_POST['doctorname'];
$name = $_POST['name'];
$age = $_POST['age'];
$date = $_POST['date'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$description = $_POST['description'];


$con = new mysqli('localhost', 'root', '', 'doctor');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$query = "UPDATE drbooking 
          SET doctorname='$doctorname', name='$name', age='$age', date='$date', phone='$phone', email='$email', description='$description' 
          WHERE id='$id'";


$result = mysqli_query($con, $query);

if ($result) {
    echo '<script>
            alert("Update successful");
            window.location.replace("bookinglist.php");
          </script>';
} else {
    echo "Error updating record: " . $con->error;
}


$con->close();

?>
