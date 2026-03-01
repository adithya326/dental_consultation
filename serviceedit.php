<?php
$id = $_GET['id']; 
$con = new mysqli('localhost', 'root', '', 'doctor');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = "SELECT service_name, description, category, price, duration, available_appointment, special_requirement FROM service WHERE id='$id'";
$result = $con->query($query);

if ($row = $result->fetch_assoc()) {
    $service_name = $row['service_name'];
    $description = $row['description'];
    $category = $row['category'];
    $price = $row['price'];
    $duration = $row['duration'];
    $available_appointment = $row['available_appointment'];
    $special_requirement = $row['special_requirement'];
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
    <h2>Edit Service Details</h2>
    <form action="servicesubmit.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="mb-3">
            <label for="service_name" class="form-label">service_name :</label>
            <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo $service_name; ?>" >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description:</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>" requir>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">category :</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>" requir>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">price:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">duration :</label>
            <input type="time" class="form-control" id="duration" name="duration" value="<?php echo $duration; ?>" requir>
        </div>
        
        <div class="mb-3">
            <label for="available_appointment" class="form-label">available_appointment :</label>
            <input type="time" class="form-control" id="available_appointment" name="available_appointment" value="<?php echo $available_appointment; ?>" requir>
        </div>

        <div class="mb-3">
            <label for="special_requirement" class="form-label">special_requirement :</label>
            <input type="text" class="form-control" id="special_requirement" name="special_requirement" value="<?php echo $special_requirement; ?>" require>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // Set minimum date to today's date
    document.getElementById('date').setAttribute('min', new Date().toISOString().split('T')[0]);
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
