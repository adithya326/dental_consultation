<?php
$id = $_GET['id']; 
$con = new mysqli('localhost', 'root', '', 'doctor');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = "SELECT select_a_service, select_doctor, name, email, appointment_date, appointment_time, location FROM appoint WHERE id='$id'";
$result = $con->query($query);

if ($row = $result->fetch_assoc()) {
                  
                   $select_a_service = $row['select_a_service'];
                   $select_doctor = $row['select_doctor'];
                   $name = $row['name'];
                   $email = $row['email'];
                   $appointment_date = $row['appointment_date'];
                   $appointment_time = $row['appointment_time'];
                   $location = $row['location'];
                   
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
    <title>Document</title>
</head>
<body>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333333;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Appointment Details</h2>
    <form action="appointsubmit.php" method="POST" enctype="multipart/form-data">
        
        <!-- Patient ID (Hidden Field) -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Service -->
        <div class="mb-3">
            <label for="select_a_service" class="form-label">Service:</label>
            <input type="text" class="form-control" id="select_a_service" name="select_a_service" value="<?php echo $select_a_service; ?>" required>
        </div>

        <!-- Doctor -->
        <div class="mb-3">
            <label for="select_doctor" class="form-label">Doctor:</label>
            <input type="text" class="form-control" id="select_doctor" name="select_doctor" value="<?php echo $select_doctor; ?>" >
        </div>

        <!-- Name (Read-Only) -->
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" readonly>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
        </div>

        <!-- Appointment Date (Read-Only) -->
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Appointment Date:</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment_date; ?>" >
        </div>
        
        <!-- Appointment Time (Read-Only) -->
        <div class="mb-3">
            <label for="appointment_time" class="form-label">Appointment Time:</label>
            <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $appointment_time; ?>" >
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // Set minimum date to today's date
    document.getElementById('appointment_date').setAttribute('min', new Date().toISOString().split('T')[0]);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

