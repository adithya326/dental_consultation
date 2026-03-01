<?php
$doctorname = $_POST['doctorname'];
$experience = $_POST['experience'];
$description = $_POST['description'];
$location = $_POST['location'];
$available_time = $_POST['available_time'];

if (isset($_FILES['doctorimage']) && $_FILES['doctorimage']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['doctorimage']['tmp_name'];
    $fileName = $_FILES['doctorimage']['name'];
    $fileSize = $_FILES['doctorimage']['size'];
    $fileType = $_FILES['doctorimage']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif','jfif');

    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique name to avoid overwriting
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = "uploads/" . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $doctorimage = $uploadPath;
        } else {
            echo "<script>alert('Error uploading the file.');window.location.replace('doc.html');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Invalid file extension');window.location.replace('doc.html');</script>";
        exit;
    }
} else {
    $error = $_FILES['doctorimage']['error'];
    echo "<script>alert('File upload error: $error');window.location.replace('doc.html');</script>";
    exit;
}

$con = new mysqli('localhost', 'root', '', 'doctor');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Escaping strings to avoid SQL Injection
$doctorname = $con->real_escape_string($doctorname);
$experience = $con->real_escape_string($experience);
$description = $con->real_escape_string($description);
$location = $con->real_escape_string($location);
$available_time = $con->real_escape_string($available_time);
$doctorimage = $con->real_escape_string($doctorimage);

$sql = "INSERT INTO drs_form (doctorname, experience, description, location, available_time, doctorimage) 
        VALUES ('$doctorname','$experience','$description','$location','$available_time','$doctorimage')";

if ($con->query($sql) === TRUE) {
    echo "<script>alert('Doctor added successfully');window.location.replace('doc.html');</script>";
} else {
    echo "<script>alert('Error in processing: " . $con->error . "');window.location.replace('doc.html');</script>";
}

$con->close();
?>
