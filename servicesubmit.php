<?php

    $id = $_POST['id'];
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $available_appointment = $_POST['available_appointment'];
    $special_requirement = $_POST['special_requirement'];


$con = new mysqli('localhost', 'root', '', 'doctor');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$query = "UPDATE service 
          SET service_name='$service_name', description='$description', category='$category',
           price='$price', duration='$duration', available_appointment='$available_appointment', special_requirement='$special_requirement' 
          WHERE id='$id'";


$result = mysqli_query($con, $query);

if ($result) {
    echo '<script>
            alert("Update successful");
            window.location.replace("serviceview.php");
          </script>';
} else {
    echo "Error updating record: " . $con->error;
}


$con->close();

?>
