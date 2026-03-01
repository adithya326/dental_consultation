<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Search Results</title>
    <style>
        /* Card styling */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            width: 300px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            vertical-align: top;
        }
        .card img {
            max-width: 100%;
            border-radius: 8px;
        }
        .card h3 {
            margin: 8px 0;
            font-size: 1.2em;
        }
        .book-now-btn {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
            width: 100%;
        }
    </style>
</head>
<body>

<?php
$location = $_GET['location'];
$con = new mysqli('localhost', 'root', '', 'doctor');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$q = "SELECT * FROM drs_form WHERE location='$location'";
$result = mysqli_query($con, $q);

// Fetch results and display in card format
while ($row = mysqli_fetch_assoc($result)) {
    $doctorname = $row['doctorname'];
    $experience = $row['experience'];
    $description = $row['description'];
    $location = $row['location'];
    $available_time = $row['available_time'];
    $doctorimage = $row['doctorimage'];
    $doctor_id = $row['id'];
    ?>
    <div class="card">
        <img src="<?php echo $doctorimage; ?>" alt="Doctor Image">
        <h3><?php echo $doctorname; ?></h3>
        <p><strong>Experience:</strong> <?php echo $experience; ?> years</p>
        <p><strong>Description:</strong> <?php echo $description; ?></p>
        <p><strong>Location:</strong> <?php echo $location; ?></p>
        <p><strong>Available Time:</strong> <?php echo $available_time; ?></p>
        
        <!-- Button to go to drbooking.html with doctor ID in the URL -->
        <button class="book-now-btn" onclick="location.href='userdrbook.php?id=<?php echo $doctor_id; ?>'">Book Now</button>
    </div>
    <?php
}

$con->close();
?>

</body>
</html>
