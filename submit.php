<?php

    
    $id = $_POST['id'];
    $doctorname = $_POST['doctorname'];
    $experience = $_POST['experience'];
    $availabletime = $_POST['available_time'];
    $description = $_POST['description'];

    
    if (isset($_FILES['doctorimage']) && $_FILES['doctorimage']['error'] === UPLOAD_ERR_OK) {
        
        $targetDir = "uploads1/";

        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        
        $fileName = basename($_FILES['doctorimage']['name']);
        $targetFilePath = $targetDir . uniqid() . "_" . $fileName;

        
        if (move_uploaded_file($_FILES['doctorimage']['tmp_name'], $targetFilePath)) {
            $rcBook = $targetFilePath; 
        } else {
            die("Failed to upload doctor image.");
        }
    } else {
        $rcBook = ''; 
    }

    
    $con = new mysqli('localhost', 'root', '', 'doctor');

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    
    $query = "UPDATE drs_form SET doctorname='$doctorname', available_time='$available_time', description='$description', doctorimage='$rcBook' WHERE id=$id";

    if ($con->query($query) === TRUE) {
        echo '<script>
            alert("Update successful");
            window.location.replace("list.php");
        </script>';
    } else {
        echo "Error updating record: " . $con->error;
    }



?>
