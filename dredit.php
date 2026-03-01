<?php
$id = $_GET['id']; 
$con = new mysqli('localhost', 'root', '', 'doctor');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = "SELECT doctorname, name, age, date, phone, email, description FROM drbooking WHERE id='$id'";
$result = $con->query($query);

if ($row = $result->fetch_assoc()) {
    $doctorname = $row['doctorname'];
    $name = $row['name'];
    $age = $row['age'];
    $date = $row['date'];
    $phone = $row['phone'];
    $email = $row['email'];
    $description = $row['description'];
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
    <h2>Edit Patient Details</h2>
    <form action="drsubmit.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="mb-3">
            <label for="doctorname" class="form-label">Doctor Name:</label>
            <input type="text" class="form-control" id="doctorname" name="doctorname" value="<?php echo htmlspecialchars($doctorname); ?>" >
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Patient Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Appointment Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" readonly>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" readonly><?php echo htmlspecialchars($description); ?></textarea>
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
