<?php
$kl = $_GET['id']; 
$con = new mysqli('localhost', 'root', '', 'doctor');


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$query = "SELECT doctorname, experience, available_time, description, doctorimage FROM drs_form WHERE id=$kl";
$result = $con->query($query);
 

if ($row = $result->fetch_assoc()) {
    $doctorname = $row['doctorname'];
   
    $experience = $row['experience'];
    $available_time = $row['available_time'];
    $description = $row['description'];
    $doctorimage = $row['doctorimage'];
} else {
    die("No record found.");
}

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Doctor Information</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($kl); ?>">

        
        <div class="mb-3">
            <label for="doctorname" class="form-label">Doctor Name:</label>
            <input type="text" class="form-control" id="doctorname" name="doctorname" value="<?php echo htmlspecialchars($doctorname); ?>" required>
        </div>

    
        

    
        <div class="mb-3">
            <label for="experience" class="form-label">Experience (Years):</label>
            <input type="number" class="form-control" id="experience" name="experience" value="<?php echo htmlspecialchars($experience); ?>" required>
        </div>

        
        <div class="mb-3">
            <label for="available_time" class="form-label">Available Time:</label>
            <input type="time" class="form-control" id="available_time" name="available_time" value="<?php echo htmlspecialchars($available_time); ?>" required>
        </div>

        
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        
        <div class="mb-3">
            <label for="doctorimage" class="form-label">Doctor Image:</label>
            <input type="file" class="form-control" id="doctorimage" name="doctorimage" accept="image/*">
            
            
            <?php if ($doctorimage): ?>
                <img src="uploads/<?php echo htmlspecialchars($doctorimage); ?>" alt="Doctor Image" class="img-thumbnail mt-2" width="150">
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
        </div>

        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
