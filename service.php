<?php
$service_name = $_POST['service_name'];
$description = $_POST['description'];
$category = $_POST['category'];
$price = $_POST['price'];
$duration = $_POST['duration'];
$available_appointment = $_POST['available_appointment'];
$special_requirement = $_POST['special_requirement'];


$image = $_FILES['image'];


if (isset($image) && $image['error'] == 0) {
   
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($image["name"]);
    

    if (move_uploaded_file($image["tmp_name"], $target_file)) {
      
        $conn = new mysqli('localhost', 'root', '', 'doctor');
        $sql = "INSERT INTO service(service_name, description, category, price, duration, available_appointment, special_requirement, image) 
                VALUES ('$service_name', '$description', '$category', '$price', '$duration', '$available_appointment', '$special_requirement', '$target_file')";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Successfully booked'); window.location.replace('admin.html');</script>";
        } else {
            echo "Booking failed: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "File upload error: " . $image['error'];
}
?>
