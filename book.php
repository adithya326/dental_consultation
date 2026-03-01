<?php

$con = new mysqli('localhost', 'root', '', 'doctor');

if (isset($_GET['id']))
 {
    $id = $_GET['id'];
    $doctorname=$_GET['doctorname'];
    $query = "SELECT * FROM drs_form WHERE id = $id";
    $result = mysqli_query($con, $query);
    $doctor = mysqli_fetch_assoc($result);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $patient_name = $_POST['patient_name'];
        $email = $_POST['email'];
        $appointment_date = $_POST['appointment_date'];
        
        
        $insert_query = "INSERT INTO bookings(doctor_id, patient_name, email, appointment_date) VALUES ('$id', '$patient_name', '$email', '$appointment_date')";
        mysqli_query($con, $insert_query);

        echo '<script>
            alert("Booking successful");
            window.location.replace("team.php");
        </script>';;
    }
} else 
0{
    echo "Doctor ID not provided!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
</head>
<body>

<h2>Book Appointment with <?php echo $doctor['doctorname']; ?></h2>

<form method="POST">
    <label for="patient_name">Patient Name:</label>
    <input type="text" name="patient_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="appointment_date">Appointment Date:</label>
    <input type="date" name="appointment_date" required><br>

    <button type="submit">Book Appointment</button>
</form>

</body>
</html>
